<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Converter\Converter;
use Illuminate\Routing\Controller as BaseController;

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

        $tmpFile = tmpfile();
        fputs($tmpFile, $countryList);

        $fileData = "";
        $converter = new Converter();
        try {
            fseek($tmpFile, 0);
            $countryList = $converter->load(stream_get_meta_data($tmpFile)['uri'], 'json');
            $fileData = $converter->save($countryList, $format);
        }
        finally {
            fclose($tmpFile);
        }

        print $fileData . "\n";
        exit(0);
        return response()->text($fileData);
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
