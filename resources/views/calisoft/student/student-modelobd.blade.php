@extends('layouts.dash')

@push('styles')
  <link rel="stylesheet" href="/modulobd/styles/style.css" media="all" />
	<!--[if IE 6]><link rel="stylesheet" type="text/css" href="styles/ie6.css" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="styles/ie7.css" /><![endif]-->
	<link rel="stylesheet" href="/modulobd/styles/print.css" type="text/css" media="print" />

@endpush

@section('content')
  <div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-database', 'title' => 'Diseño y Modelación de Base de Datos'])
      <div id="area"></div>

        <div id="controls">
          <div class="col-md-24">
            <div class="col-md-24">
          <div id="bar">
            <div id="toggle"></div>
            <input type="button" class="btn green-jungle" id="saveload" />
            <input type="button" class="btn btn-danger" id="options" />
  
            <input type="button" class="btn btn-primary" id="addtable" />
            <input type="button" class="btn btn-primary" id="edittable" />
            <input type="button" class="btn btn-primary" id="tablekeys" />
            <input type="button" class="btn btn-primary" id="removetable" />
            <input type="button" style="display: none;" class="btn btn-primary" id="aligntables" />
            <input type="button" class="btn btn-primary" id="cleartables" />

            <hr>

            <input type="button" class="btn btn-primary" id="addrow" />
            <input type="button" class="btn btn-primary" id="editrow" />
            <input type="button" class="btn btn-primary" id="uprow" /><input type="button" class="btn btn-primary" id="downrow" />
            <input type="button" class="btn btn-primary" id="foreigncreate" />
            <input type="button" class="btn btn-primary" id="foreignconnect" />
            <input type="button" class="btn btn-primary" id="foreigndisconnect" />
            <input type="button" class="btn btn-primary" id="removerow" />
            <hr/>

            <input style="display: none;" type="button" id="docs" value="" />
          </div>
        </div>
      </div>

  <div id="rubberband"></div>

  <div id="minimap"></div>

  <div id="background"></div>

  <div id="window">
    <div id="windowtitle"><img id="throbber" src="/modulobd/images/throbber.gif" alt="" title=""/></div>
    <div id="windowcontent"></div>
    <input type="button" style="align: center;" class="btn btn-primary" id="windowok" />
    <input type="button" class="btn btn-danger" style="align: center;" id="windowcancel" />
  </div>
</div> <!-- #controls -->

<div id="opts">
  <table class="table-bordered">
    <tbody>
      <tr>
        <td style="display: none;">
       <label style="display: none;" id="language" for="optionlocale"></label>
        </td>
        <td style="display: none;">
          <select style="display: none;" id="optionlocale"><option></option></select>
        </td>
      </tr>
      <tr>
        <td>
          <label id="db" for="optiondb"></label>
        </td>
        <td>
          <select id="optiondb"><option></option></select>
        </td>
      </tr>
      <tr>
        <td style="display: none;">
          <label style="display: none;" id="snap" for="optionsnap"></label>
        </td>
        <td style="display: none;">
          <input style="display: none;" type="text" size="4" id="optionsnap" />
          <span style="display: none;" class="small" id="optionsnapnotice"></span>
        </td>
      </tr>
      <tr>
        <td style="display: none;">
          <label id="pattern" for="optionpattern"></label>
        </td>
        <td style="display: none;">
          <input type="text" size="6" id="optionpattern" />
          <span class="small" id="optionpatternnotice"></span>
        </td>
      </tr>
      <tr>
        <td style="display: none;">
          <label id="hide" for="optionhide"></label>
        </td>
        <td style="display: none;">
          <input type="checkbox" id="optionhide" />
        </td>
      </tr>
      <tr>
        <td>
          <label id="vector" for="optionvector"></label>
        </td>
        <td>
          <input style="align: center;" type="checkbox" id="optionvector" />
        </td>
      </tr>
      <tr>
        <td>
          <label id="showsize" for="optionshowsize"></label>
        </td>
        <td>
          <input type="checkbox" id="optionshowsize" />
        </td>
      </tr>
      <tr>
        <td>
          <label id="showtype" for="optionshowtype"></label>
        </td>
        <td>
          <input type="checkbox" id="optionshowtype" />
        </td>
      </tr>
    </tbody>
  </table>

  <span style="display: none;" class="small" id="optionsnotice"></span>
</div>

<div id="io">
  <table>
    <tbody>
      <tr>
        <td>
          <fieldset>
            <legend style="display: none;" id="client"></legend>
            <button type="button" id="clientsql" class="btn btn-primary"><i class="fa fa-database"> Generar SQL</i></button>
            <div id="singlerow" style="display: none;">
            <input type="button" id="clientsave" />
            <input type="button" id="clientload" />
            </div>
            <div id="singlerow" style="display: none;">
            <input type="button" id="clientlocalsave" />
            <input type="button" id="clientlocalload" />
            <input type="button" id="clientlocallist" />
            </div>
            <div id="singlerow" style="display: none;">
              <input type="button" id="dropboxsave" /><!-- may get hidden by dropBoxInit() -->
              <input type="button" id="dropboxload" /><!-- may get hidden by dropBoxInit() -->
              <input type="button" id="dropboxlist" /><!-- may get hidden by dropBoxInit() -->
            </div>
          </fieldset>
        </td>
        <td style="width:40%">
          <fieldset>
            <legend style="display: none;" id="server"></legend>
            <label style="display: none;" for="backend" id="backendlabel"></label> <select style="display: none;" id="backend"><option></option></select>

            <input style="display: none;" type="button" id="serversave" />
            <input style="display: none;" type="button" id="quicksave" />
            <input style="display: none;" type="button" id="serverload" />
            <input style="display: none;" type="button" id="serverlist" />
            <input style="display: none;" type="button" id="serverimport" />
          </fieldset>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <fieldset>
            <br>
            <legend style="display: none;" id="output"></legend>
            <textarea id="textarea" rows="1" cols="1"></textarea><!--modified by javascript later-->
          </fieldset>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<div id="keys">
  <fieldset>
    <legend id="keyslistlabel"></legend>
    <select id="keyslist"><option></option></select>
    <input type="button" id="keyadd" />
    <input type="button" id="keyremove" />
  </fieldset>
  <fieldset>
    <legend id="keyedit"></legend>
    <table>
      <tbody>
        <tr>
          <td>
            <label for="keytype" id="keytypelabel"></label>
            <select id="keytype"><option></option></select>
          </td>
          <td></td>
          <td>
            <label for="keyname" id="keynamelabel"></label>
            <input type="text" id="keyname" size="10" />
          </td>
        </tr>
        <tr>
          <td colspan="3"><hr/></td>
        </tr>
        <tr>
          <td>
            <label for="keyfields" id="keyfieldslabel"></label><br/>
            <select id="keyfields" size="5" multiple="multiple"><option></option></select>
          </td>
          <td>
            <input type="button" id="keyleft" value="&lt;&lt;" /><br/>
            <input type="button" id="keyright" value="&gt;&gt;" /><br/>
          </td>
          <td>
            <label for="keyavail" id="keyavaillabel"></label><br/>
            <select id="keyavail" size="5" multiple="multiple"><option></option></select>
          </td>
        </tr>
      </tbody>
    </table>
  </fieldset>
</div>

<div id="table">
  <table>
    <tbody>
      <tr>
        <td>
          <label id="tablenamelabel" for="tablename"></label>
        </td>
        <td>
          <input id="tablename" type="text" />
        </td>
      </tr>

      <tr>
        <td>
          <label id="tablecommentlabel" for="tablecomment"></label>
        </td>
        <td>
          <textarea rows="5" cols="40" id="tablecomment"></textarea>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@include('partials.modal-help-diseño-basedatos')
@endcomponent
</div>
@endsection

@push('functions')
  <script src="/js/bootstrap.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dropbox.js/0.10.2/dropbox.min.js"></script>
	<script src="/modulobd/js/oz.js"></script>
	<script src="/modulobd/js/config.js"></script>
	<script src="/modulobd/js/globals.js"></script>
	<script src="/modulobd/js/visual.js"></script>
	<script src="/modulobd/js/row.js"></script>
	<script src="/modulobd/js/table.js"></script>
	<script src="/modulobd/js/relation.js"></script>
	<script src="/modulobd/js/key.js"></script>
	<script src="/modulobd/js/rubberband.js"></script>
	<script src="/modulobd/js/map.js"></script>
	<script src="/modulobd/js/toggle.js"></script>
	<script src="/modulobd/js/io.js"></script>
	<script src="/modulobd/js/tablemanager.js"></script>
	<script src="/modulobd/js/rowmanager.js"></script>
	<script src="/modulobd/js/keymanager.js"></script>
	<script src="/modulobd/js/window.js"></script>
	<script src="/modulobd/js/options.js"></script>
	<script src="/modulobd/js/wwwsqldesigner.js"></script>
  <script type="text/javascript">
    var d = new SQL.Designer();
  </script>
@endpush
