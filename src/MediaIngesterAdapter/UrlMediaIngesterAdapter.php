<?php
namespace XMLImport1\MediaIngesterAdapter;

class UrlMediaIngesterAdapter implements MediaIngesterAdapterInterface
{
    public function getJson($mediaDatum)
    {
        $mediaDatumJson = [];
        $mediaDatumJson['ingest_url'] = $mediaDatum;
        return $mediaDatumJson;
    }
}
