@extends('layouts.v2.master')

@section('title', 'E-Numbers List')

@section('css')
    @parent
@endsection

@section('body')
    <?php
    $iName = str_replace(" ","+",$ingredient->iName);

    $DBpedia = @file_get_contents("http://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=select+%3Fresource+%3Fabstract%0D%0Awhere+%7B+%0D%0A%3Fresource+rdfs%3Alabel+%22". $iName ."%22%40en+.%0D%0A%3Fresource+dbo%3Aabstract+%3Fabstract%0D%0A+FILTER+%28+lang%28%3Fabstract%29+%3D+%22en%22+%29%0D%0A%7D+&format=application%2Fsparql-results%2Bjson&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on");
    if($DBpedia === FALSE) {

    }
    $DBpediaDecode = json_decode($DBpedia, true);
    $DBpediaDecode = $DBpediaDecode["results"];
    $DBpediaDecode = $DBpediaDecode["bindings"];
    if(!empty($DBpediaDecode)){
        $DBpediaDecode1st = $DBpediaDecode[0];
        $DBResource = $DBpediaDecode1st["resource"];
        $DBAbstract = $DBpediaDecode1st["abstract"];
    }

    $MESH = @file_get_contents("https://id.nlm.nih.gov/mesh/sparql?query=PREFIX%20rdf%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX%20rdfs%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX%20xsd%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0D%0APREFIX%20owl%3A%20%3Chttp%3A%2F%2Fwww.w3.org%2F2002%2F07%2Fowl%23%3E%0D%0APREFIX%20meshv%3A%20%3Chttp%3A%2F%2Fid.nlm.nih.gov%2Fmesh%2Fvocab%23%3E%0D%0APREFIX%20mesh%3A%20%3Chttp%3A%2F%2Fid.nlm.nih.gov%2Fmesh%2F%3E%0D%0APREFIX%20mesh2015%3A%20%3Chttp%3A%2F%2Fid.nlm.nih.gov%2Fmesh%2F2015%2F%3E%0D%0APREFIX%20mesh2016%3A%20%3Chttp%3A%2F%2Fid.nlm.nih.gov%2Fmesh%2F2016%2F%3E%0D%0A%0D%0ASELECT%20DISTINCT%20%3Fresource%20%3FpharmacologicalAction%20%3FscopeNote%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20FROM%20%3Chttp%3A%2F%2Fid.nlm.nih.gov%2Fmesh%3E%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20WHERE%20%7B%20%3Fresource%20rdfs%3Alabel%20%22" . $iName . "%22%40en%20.%20%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Fresource%20a%20meshv%3ATopicalDescriptor%20.%20%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Fresource%20meshv%3ApharmacologicalAction%20%3Fb%20.%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Fb%20rdfs%3Alabel%20%3FpharmacologicalAction%20.%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Fresource%20meshv%3ApreferredConcept%20%3Fd%20.%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Fd%20meshv%3AscopeNote%20%3FscopeNote%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%7D&format=JSON&limit=50&offset=0&inference=false");
    if($MESH === FALSE) {

    }
    $MESHdecode = json_decode($MESH, true);
    $MESHdecode = $MESHdecode["results"];
    $MESHdecode = $MESHdecode["bindings"];
    if(!empty($MESHdecode)){
        $MESHdecode1st = $MESHdecode["0"];
        $MESHResource = $MESHdecode1st["resource"];
        $MESHResource = $MESHResource["value"];
        $MESHScopeNote = $MESHdecode1st["scopeNote"];
        $MESHScopeNote = $MESHScopeNote["value"];

        $MID = explode('/', $MESHResource);
        $MID = $MID[count($MID) - 1];
    }

    $PUBCHEM = @file_get_contents("https://pubchem.ncbi.nlm.nih.gov/rest/rdf/query?graph=synonym&name=" . $iName . "&return=compound&format=json");
    if($PUBCHEM === FALSE) {

    }
    $PUBCHEMdecode = json_decode($PUBCHEM, true);
    $PUBCHEMdecode = $PUBCHEMdecode["results"];
    $PUBCHEMdecode = $PUBCHEMdecode["bindings"];
    if(!empty($PUBCHEMdecode)){
        $PUBCHEMdecode = $PUBCHEMdecode["0"];
        $CID = $PUBCHEMdecode['cid'];
        $CID = $CID['value'];
        $CID = explode('/', $CID);
        $CID = $CID[count($CID) - 1];
        $CIDmin = substr($CID, 3);
    }
    ?>
    <div class="container">
        <h1>{{ $ingredient->iName }} </h1>
        <div class="row">
            <div class="col-md-3 col-sm-5">
                @if(isset($CIDmin))
                    <img class="img-responsive" src="https://pubchem.ncbi.nlm.nih.gov/image/imagefly.cgi?cid={{ $CIDmin }}&width=250&height=300">
                @else
                    <p>Image Not Found</p>
                @endif
            </div>
            <div class="col-md-9 col-sm-7">
                <div class="row">
                    <label class="col-md-3">E-Numbers</label>
                    <div class="col-md-9">
                        <p class="  ">{{ $ingredient->eNumber }}</p>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3">MeSH ID</label>
                    <div class="col-md-9">
                        @if(isset($MID))
                            <p class="  ">{{ $MID }}</p>
                        @else
                            <p class="  ">Not Determined</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-3">Pubchem CID</label>
                    <div class="col-md-9">
                        @if(isset($CID))
                            <p>{{ $CID }}</p>
                        @else
                            <p>Not Determined</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Role</label>
                        <ul>
                            @if(!empty($MESHdecode))
                                <?php
                                foreach ($MESHdecode as $row) {
                                    $MESHPharmacologicalAction = $row["pharmacologicalAction"];
                                    $MESHPharmacologicalAction = $MESHPharmacologicalAction["value"];
                                    echo '<li>' . $MESHPharmacologicalAction . '</li>';
                                }
                                ?>
                            @else
                            <li>Not determined</li>
                            @endif
                        </ul>
                    </div>
                </div>
                @if(isset($halalSource))
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Organization</th>
                            </thead>
                            @foreach($halalSource as $halal)
                                <tr>
                                    @if($halal->hStatus == 0)
                                        <td>Halal</td>
                                    @elseif($halal->hStatus == 1)
                                        <td>Mushbooh</td>
                                    @else
                                        <td>Haraam</td>
                                    @endif
                                    <td>{{ $halal->hDescription }} - <a href="{{ $halal->hUrl }}">Read More</a> </td>
                                    <td>{{ $halal->hOrganization }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>Description</label>
                {{--@if(isset($result[0]))--}}
                    {{--@foreach ($result as $data) @endforeach--}}
                    {{--<p>{{ $data->abstract }}</p>--}}
                    {{--<p class="text-right"><a href="{{ $data->resource }}">Read More</a></p>--}}
                {{--@else--}}
                    {{--<p>DBpedia description not found</p>--}}
                {{--@endif--}}
                @if(isset($DBAbstract))
                    <p>{{ $DBAbstract["value"] }}</p>
                    <p class="text-right"><a href="{{ $DBResource["value"] }}">Read More</a></p>
                @else
                    <p>DBpedia description not found</p>
                @endif
                @if(isset($MESHScopeNote))
                    <p>{{ $MESHScopeNote }}</p>
                    <p class="text-right"><a href="{{ $MESHResource }}">Read More</a></p>
                @else
                    <p>MESH description not found</p>
                @endif
            </div>
        </div>
    </div> <!-- /container -->
<br><br><br><br><br><br><br><br><br>
@endsection

@section('js')
    @parent
@endsection
