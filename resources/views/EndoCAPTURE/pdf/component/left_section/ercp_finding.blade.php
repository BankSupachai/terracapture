<tr class="set-font-family">
    <td>
        <table>
            <tr class="lh-8px">
                <td colspan="2"><span class="casetitle">Findings</span></td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Stomach & Duodenum</span></td>
                <td>:
                    @if(isset($json->stomach_duodenum))
                    <span class="casetext">{{@$json->stomach_duodenum}}</span>
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Ampulla</span></td>
                <td>:
                    @if(isset($json->ampulla))
                    <span class="casetext">{{@$json->ampulla}}</span>
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Common bile duct cannulation</span></td>
                <td>:
                    @if(isset($json->common_bile))
                    <span class="casetext">{{@$json->common_bile}}</span>
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Pancreatic duct cannulation</span></td>
                <td>:
                    @if(isset($json->pancreatic_duct))
                    <span class="casetext">{{@$json->pancreatic_duct}}</span>
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Pancreatogram</span></td>
                <td>:
                    @if(isset($json->pancreatogram))
                    <span class="casetext">{{@$json->pancreatogram}}</span>
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Cholangiogram</span></td>
                <td>:
                    @if(isset($json->cholangiogram))
                    <span class="casetext">{{@$json->cholangiogram}}</span>
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Sphincterotomy</span></td>
                <td>:
                    @if(isset($json->sphincterotomy_not)||isset($json->sphincterotomy_est)||isset($json->sphincterotomy_cut))
                        @if (isset($json->sphincterotomy_not))
                        <span class="casetext">Not done &nbsp;</span>
                        @endif
                        @if (isset($json->sphincterotomy_est))
                        <span class="casetext">EST &nbsp;</span>
                        @endif
                        @if (isset($json->sphincterotomy_cut))
                        <span class="casetext">Pre cut &nbsp;</span>
                        @endif
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Balloon extraction</span></td>
                <td>:
                    @if(isset($json->balloon_not)||isset($json->balloon_not_text))
                        @if (isset($json->balloon_not))
                        <span class="casetext">Not done &nbsp;</span>
                        @endif
                        @if (isset($json->balloon_not_text))
                        <span class="casetext">{{@$json->balloon_not_text}}</span>
                        @endif
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Dilation</span></td>
                <td>:
                    @if(isset($json->dilation_not)||isset($json->dilation_not_text))
                        @if (isset($json->dilation_not))
                        <span class="casetext">Not done &nbsp;</span>
                        @endif
                        @if (isset($json->dilation_not_text))
                        <span class="casetext">{{@$json->dilation_not_text}}</span>
                        @endif
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Stent</span></td>
                <td>:
                    @if(isset($json->stent_not)||isset($json->stent_not_text))
                        @if (isset($json->stent_not))
                        <span class="casetext">Not done &nbsp;</span>
                        @endif
                        @if (isset($json->stent_not_text))
                        <span class="casetext">{{@$json->stent_not_text}}</span>
                        @endif
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
            <tr class="lh-8px">
                <td><span class="findtitle">Other</span></td>
                <td>:
                    @if(isset($json->ercp_other))
                    <span class="casetext">{{@$json->ercp_other}}</span>
                    @else
                        <span class="casetext">N/A</span>
                    @endif
                </td>
            </tr>
        </table>
    </td>
</tr>
