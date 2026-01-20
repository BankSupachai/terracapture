
@php
use App\Models\Mongo;
    if(isset($casedata->room)){
        $id = intval($casedata->room);
        $tb_room = Mongo::table('tb_room')->where('room_id',$id)->first();
    }

    $isLongWriting = (isset($type) && $type == 'long_writing') || (isset($pdftype) && $pdftype == 'long_writing') || (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing');
    $isColonoscopy = (isset($procedure) && $procedure->name == 'Colonoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Colonoscopy');
    $isERCP = (isset($procedure) && $procedure->name == 'ERCP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ERCP');
    $isEUS = (isset($procedure) && $procedure->name == 'EUS') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EUS');
    $isEGD = (isset($procedure) && $procedure->name == 'EGD') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EGD');
    $isENT = (isset($procedure) && $procedure->name == 'ENT') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ENT');
    $isBronchoscopy = (isset($procedure) && $procedure->name == 'Bronchoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Bronchoscopy');
    $liverBiopsyName = isset($procedure) && isset($procedure->name) ? trim($procedure->name) : (isset($casedata->procedure_name) ? trim($casedata->procedure_name) : '');
    $isLiverBiopsy = !empty($liverBiopsyName) && strtolower(str_replace([' ', '_', '-'], '', $liverBiopsyName)) === 'liverbiopsy';
    $isEnteroscopy = (isset($procedure) && $procedure->name == 'Enteroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Enteroscopy');
    $isManometry = (isset($procedure) && $procedure->name == 'Manometry') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Manometry');
    $isLaparoscopy = (isset($procedure) && $procedure->name == 'Laparoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Laparoscopy');
    $isAnterogradeDBE = (isset($procedure) && $procedure->name == 'Anterograde DBE') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Anterograde DBE');
    $isApolloEndosurgery = (isset($procedure) && $procedure->name == 'Apollo Endosurgery') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Apollo Endosurgery');
    $isArthrobrostrom = (isset($procedure) && $procedure->name == 'Arthrobrostrom') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Arthrobrostrom');
    $isArthroscopy = (isset($procedure) && $procedure->name == 'Arthroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Arthroscopy');
    $isBCG = (isset($procedure) && $procedure->name == 'BCG') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'BCG');
    $isColonicStent = (isset($procedure) && $procedure->name == 'Colonic Stent') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Colonic Stent');
    $isChangejejunostomy = (isset($procedure) && $procedure->name == 'Change jejunostomy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Change jejunostomy');
    $isChangePCN = (isset($procedure) && $procedure->name == 'Change PCN') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Change PCN');
    $isCREBalloonDilatation = (isset($procedure) && $procedure->name == 'CRE Balloon Dilatation') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'CRE Balloon Dilatation');
    $isChangeDSstent = (isset($procedure) && $procedure->name == 'Change DS stent') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Change DS stent');
    $isCystowithDJstent = (isset($procedure) && $procedure->name == 'Cysto with DJ stent') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Cysto with DJ stent');
    $isCystowithRP = (isset($procedure) && $procedure->name == 'Cysto with RP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Cysto with RP');
    $isCystostomy = (isset($procedure) && $procedure->name == 'Cystostomy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Cystostomy');
    $isDuodenoscopy = (isset($procedure) && $procedure->name == 'Duodenoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Duodenoscopy');
    $isCystogram = (isset($procedure) && $procedure->name == 'Cystogram') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Cystogram');
    $isEBUS = (isset($procedure) && $procedure->name == 'EBUS') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EBUS');
    $isRP = (isset($procedure) && $procedure->name == 'RP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'RP');
    $isNasalEndoscopy = (isset($procedure) && $procedure->name == 'Nasal Endoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Nasal Endoscopy');
    $isKidneyBiopsy = (isset($procedure) && $procedure->name == 'Kidney Biopsy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Kidney Biopsy');
    $isFlexibleLaryngoscopy = (isset($procedure) && $procedure->name == 'Flexible Laryngoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Flexible Laryngoscopy');
    $isERP = (isset($procedure) && $procedure->name == 'ERP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ERP');
    $isNasojejunostomy = (isset($procedure) && $procedure->name == 'Nasojejunostomy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Nasojejunostomy');
    $isKneeArthroscopy = (isset($procedure) && $procedure->name == 'Knee Arthroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Knee Arthroscopy');
    $isInsertNJ = (isset($procedure) && $procedure->name == 'Insert NJ') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Insert NJ');
    $isFEES = (isset($procedure) && $procedure->name == 'FEES') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'FEES');
    $isPCN = (isset($procedure) && $procedure->name == 'PCN') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'PCN');
    $isPOEM = (isset($procedure) && $procedure->name == 'POEM') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'POEM');
    $isRetrogradeDBE = (isset($procedure) && $procedure->name == 'Retrograde DBE') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Retrograde DBE');
    $isPercutaneousDilatationalTracheostomy = (isset($procedure) && $procedure->name == 'Percutaneous Dilatational Tracheostomy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Percutaneous Dilatational Tracheostomy');
    $isHipArthroscopy = (isset($procedure) && $procedure->name == 'Hip Arthroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Hip Arthroscopy');
    $isHandArthroscopy = (isset($procedure) && $procedure->name == 'Hand Arthroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Hand Arthroscopy');
    $isFlexibleCystoscopy = (isset($procedure) && $procedure->name == 'Flexible Cystoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Flexible Cystoscopy');
    $isEsophagealStent = (isset($procedure) && $procedure->name == 'Esophageal Stent') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Esophageal Stent');
    $isEarEndoscopy = (isset($procedure) && $procedure->name == 'Ear Endoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Ear Endoscopy');
    $isFlexibleSigmoidoscopy = (isset($procedure) && $procedure->name == 'Flexible Sigmoidoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Flexible Sigmoidoscopy');
    $isFluoroscopy = (isset($procedure) && $procedure->name == 'Fluoroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Fluoroscopy');
    $isPleuroscopy = (isset($procedure) && $procedure->name == 'Pleuroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Pleuroscopy');
    $isPEG = (isset($procedure) && $procedure->name == 'PEG') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'PEG');
    $isRigidBronchoscopy = (isset($procedure) && $procedure->name == 'Rigid Bronchoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Rigid Bronchoscopy');
    $isPushEnteroscopy = (isset($procedure) && $procedure->name == 'Push Enteroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Push Enteroscopy');
    $isDoubleBalloonEnteroscopy = (isset($procedure) && $procedure->name == 'Double Balloon Enteroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Double Balloon Enteroscopy');

    if($isERCP) {
      if($isLongWriting) {
        $paddingLeft = '74px';
        } else {
        $paddingLeft = '74px';
        }
   } elseif($isLiverBiopsy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '77px';
        }
    } elseif($isKidneyBiopsy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isRigidBronchoscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isRetrogradeDBE) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '82px';
        }
    } elseif($isRP) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isPushEnteroscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isPleuroscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isPercutaneousDilatationalTracheostomy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
        } elseif($isPOEM) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isPEG) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isPCN) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isNasojejunostomy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isNasalEndoscopy) {
        if($isLongWriting) {
            $paddingLeft = '85px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isKneeArthroscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isHipArthroscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isInsertNJ) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isFlexibleCystoscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isHandArthroscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isFluoroscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isFlexibleSigmoidoscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
     } elseif($isFlexibleLaryngoscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isEsophagealStent) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
     } elseif($isFEES) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isEarEndoscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isEBUS) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isERP) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isENT) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isDuodenoscopy) {
        if($isLongWriting) {
            $paddingLeft = '85px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isDoubleBalloonEnteroscopy) {
        if($isLongWriting) {
            $paddingLeft = '81px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isCystostomy) {
        if($isLongWriting) {
            $paddingLeft = '85px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isCystogram) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isCystowithDJstent) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isColonicStent) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '83px';
        }
     } elseif($isCystowithRP) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isChangePCN) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '82px';
        }
     } elseif($isChangejejunostomy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '82px';
        }
     } elseif($isChangeDSstent) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isCREBalloonDilatation) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
   } elseif($isArthrobrostrom) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
    } elseif($isBCG) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
   } elseif($isArthroscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '81px';
        }
     } elseif($isAnterogradeDBE) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '82px';
        }
     } elseif($isApolloEndosurgery) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '82px';
        }
    } elseif($isEnteroscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isLaparoscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
    } elseif($isManometry) {
        if($isLongWriting) {
            $paddingLeft = '84px';
             } else {
            $paddingLeft = '80px';
        }
     } elseif($isBronchoscopy) {
        if($isLongWriting) {
            $paddingLeft = '84px';
        } else {
            $paddingLeft = '79px';
        }
    } elseif($isEUS) {
        if($isLongWriting) {
            $paddingLeft = '85px';
        } else {
            $paddingLeft = '82px';
        }
    } elseif($isColonoscopy) {
        if($isLongWriting) {
            $paddingLeft = '83px';
        } else {
            $paddingLeft = '80px';
        }
    } else {
        $paddingLeft = '76px';
    }

@endphp
<tr style="line-height:{{$body_line}};" class="lh-6 set-font-family" >
    &nbsp;&nbsp;&nbsp;
    <td style="padding-top: 0px;">
        <div style="margin-top: -9px;">
            <span class="casetitle">PLACE :</span>
            <span class="casetext" style="padding-left: {{$paddingLeft}};{{ $isColonoscopy ? 'margin-top: 5px;' : ($isEGD ? 'margin-top: 3px;' : '') }}">
                {{-- @dd($tb_room->room_name) --}}
                @isset($tb_room)
                    {{@$tb_room->room_name}}
                @else
                    {{@$casedata->room != null ? $casedata->room:'-'}}
                @endisset
            </span>
        </div>
    </td>
</tr>
