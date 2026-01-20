<div class="row">
    <div class="col-12">
        <h5 class="card-label">
            FINDINGS
        </h5>
    </div>
</div>
<table class="table table-borderless">
    <tr>
        <td>Stomach & Duodenum :</td>
        <td><input type="text" name="" id="stomach_duodenum" class="form-control form-control-sm savejson"
                value="{{ @$case->stomach_duodenum }}"></td>
    </tr>
    <tr>
        <td>Ampulla : </td>
        <td><input type="text" name="" id="ampulla" class="form-control form-control-sm savejson"
                value="{{ @$case->ampulla }}"></td>
    </tr>
    <tr>
        <td>Common bile duct cannulation :</td>
        <td><input type="text" name="" id="common_bile" class="form-control form-control-sm savejson"
                value="{{ @$case->common_bile }}"></td>
    </tr>
    <tr>
        <td>Pancreatic duct cannulation :</td>
        <td><input type="text" name="" id="pancreatic_duct" class="form-control form-control-sm savejson"
                value="{{ @$case->pancreatic_duct }}"></td>
    </tr>
    <tr>
        <td>Pancreatogram : </td>
        <td><input type="text" name="" id="pancreatogram" class="form-control form-control-sm savejson"
                value="{{ @$case->pancreatogram }}"></td>
    </tr>
    <tr>
        <td>Cholangiogram : </td>
        <td><input type="text" name="" id="cholangiogram" class="form-control form-control-sm savejson"
                value="{{ @$case->cholangiogram }}"></td>
    </tr>
    <tr>
        <td>Sphincterotomy : </td>
        <td>
            <div class="row">
                <div class="col-auto">
                    <input type="checkbox" name="sphincterotomy_not" class="savejson_checkbox" id="sphincterotomy_not"
                        value="sphincterotomy_not" {{ checkselect('sphincterotomy_not', @$case->sphincterotomy_not) }}>
                    <label for="anesthesia1">Not done</label>
                </div>
                <div class="col-auto">
                    <input type="checkbox" name="sphincterotomy_est" class="savejson_checkbox" id="sphincterotomy_est"
                        value="sphincterotomy_est" {{ checkselect('sphincterotomy_est', @$case->sphincterotomy_est) }}>
                    <label for="anesthesia1">EST</label>
                </div>
                <div class="col-auto">
                    <input type="checkbox" name="sphincterotomy_cut" class="savejson_checkbox" id="sphincterotomy_cut"
                        value="sphincterotomy_cut" {{ checkselect('sphincterotomy_cut', @$case->sphincterotomy_cut) }}>
                    <label for="anesthesia1">Pre cut</label>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>Balloon extraction : </td>
        <td>
            <div class="row">
                <div class="col-auto">
                    <input type="checkbox" name="balloon_not" class="savejson_checkbox" id="balloon_not"
                        value="balloon_not" {{ checkselect('balloon_not', @$case->balloon_not) }}>
                    <label for="balloon_not">Not done</label>
                </div>
                <div class="col"><input type="text" name="balloon_not_text" id="balloon_not_text"
                        class="form-control form-control-sm savejson" value="{{ @$case->balloon_not_text }}"></div>
            </div>
        </td>
    </tr>
    <tr>
        <td>Dilation : </td>
        <td>
            <div class="row">
                <div class="col-auto">
                    <input type="checkbox" name="dilation_not" class="savejson_checkbox" id="dilation_not"
                        value="dilation_not" {{ checkselect('dilation_not', @$case->dilation_not) }}>
                    <label for="anesthesia1">Not done</label>
                </div>
                <div class="col"><input type="text" name="dilation_not_text" id="dilation_not_text"
                        class="form-control form-control-sm savejson" value="{{ @$case->dilation_not_text }}"></div>
            </div>
        </td>
    </tr>
    <tr>
        <td>Stent : </td>
        <td>
            <div class="row">
                <div class="col-auto">
                    <input type="checkbox" name="stent_not" class="savejson_checkbox" id="stent_not" value="stent_not"
                        {{ checkselect('stent_not', @$case->stent_not) }}>
                    <label for="anesthesia1">Not done</label>
                </div>
                <div class="col"><input type="text" name="stent_not_text" id="stent_not_text"
                        class="form-control form-control-sm savejson" value="{{ @$case->stent_not_text }}"></div>
            </div>
        </td>
    </tr>
    <tr>
        <td>Other : </td>
        <td><input type="text" name="ercp_other" id="ercp_other" class="form-control form-control-sm savejson"
                value="{{ @$case->ercp_other }}"></td>
    </tr>
</table>
