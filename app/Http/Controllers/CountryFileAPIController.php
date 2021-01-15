<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Converter\Converter;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class CountryFileAPIController extends BaseController
{
    /**
     * Parse file with country list and return JS friendly data structure
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $file = $request->file('fileToUpload');
        $converter = new Converter();
        $converted = $converter->load(
            $file->path(),
            strtolower($file->getClientOriginalExtension())
        );

        return response()->json(
            $converted->serialize()
        );
    }

    /**
     * Serialize JS data structure into one of the choosen file formats
     *
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $format = $data["format"];
        
        $countryList = json_encode($data["countryList"]);

        $tmpFileName = "tmp_file_" . microtime();
        Storage::disk('public')->put($tmpFileName, $countryList);

        $converter = new Converter();

        $fileData = "";
        
        try {
            $countryList = $converter->load(Storage::disk('public')->path($tmpFileName), 'json');
            $fileData = $converter->save($countryList, $format);
        }
        finally {
            Storage::disk('public')->delete($tmpFileName);
        }

        return response()->streamDownload(function () use ($converter, $format, $fileData) {
            print json_encode([
                "mime" => $converter->getMIMETypeForExtension($format),
                "data" => $fileData
            ]);
        }, "countries" . $format);
    }


    /**
     * Get list of available formats
     *
     * @return \Illuminate\Http\Response
     */
    public function listFormats()
    {
        return response()->json(
            (new Converter())->getAvailableFormats()
        );
    }
}
