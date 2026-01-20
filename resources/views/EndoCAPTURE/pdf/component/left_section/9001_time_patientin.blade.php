<tr class="set-font-family"style="line-height:{{$body_line}};">
    <td>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                @php
                    $isLongWriting = (isset($type) && $type == 'long_writing') || (isset($pdftype) && $pdftype == 'long_writing') || (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing');
                    $isColonoscopy = (isset($procedure) && $procedure->name == 'Colonoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Colonoscopy');
                    $isEGD = (isset($procedure) && $procedure->name == 'EGD') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EGD');
                    $isENT = (isset($procedure) && $procedure->name == 'ENT') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ENT');
                    $isERCP = (isset($procedure) && $procedure->name == 'ERCP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ERCP');
                    $isEUS = (isset($procedure) && $procedure->name == 'EUS') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EUS');
                    $isBronchoscopy = (isset($procedure) && $procedure->name == 'Bronchoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Bronchoscopy');
                    $isEnteroscopy = (isset($procedure) && $procedure->name == 'Enteroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Enteroscopy');
                    $isAnterogradeDBE = (isset($procedure) && $procedure->name == 'Anterograde DBE') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Anterograde DBE');
                    $isApolloEndosurgery = (isset($procedure) && $procedure->name == 'Apollo Endosurgery') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Apollo Endosurgery');
                    $isManometry = (isset($procedure) && $procedure->name == 'Manometry') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Manometry');
                    $liverBiopsyName = isset($procedure) && isset($procedure->name) ? trim($procedure->name) : (isset($casedata->procedure_name) ? trim($casedata->procedure_name) : '');
                    $isLiverBiopsy = !empty($liverBiopsyName) && strtolower(str_replace([' ', '_', '-'], '', $liverBiopsyName)) === 'liverbiopsy';
                    $isArthroscopy = (isset($procedure) && $procedure->name == 'Arthroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Arthroscopy');
                    $isBCG = (isset($procedure) && $procedure->name == 'BCG') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'BCG');
                    $isERP = (isset($procedure) && $procedure->name == 'ERP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ERP');
                    $isFEES = (isset($procedure) && $procedure->name == 'FEES') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'FEES');
                    $isCystogram = (isset($procedure) && $procedure->name == 'Cystogram') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Cystogram');
                    $isLaparoscopy = (isset($procedure) && $procedure->name == 'Laparoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Laparoscopy');
                    $isChangePCN = (isset($procedure) && $procedure->name == 'Change PCN') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Change PCN');
                    $isCystowithDJstent = (isset($procedure) && $procedure->name == 'Cysto with DJ stent') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Cysto with DJ stent');
                    $isColonicStent = (isset($procedure) && $procedure->name == 'Colonic Stent') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Colonic Stent');
                    $isChangejejunostomy = (isset($procedure) && $procedure->name == 'Change jejunostomy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Change jejunostomy');
                    $isChangeDSstent = (isset($procedure) && $procedure->name == 'Change DS stent') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Change DS stent');
                    $isCystowithRP = (isset($procedure) && $procedure->name == 'Cysto with RP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Cysto with RP');
                    $isCystostomy = (isset($procedure) && $procedure->name == 'Cystostomy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Cystostomy');
                    $isEBUS = (isset($procedure) && $procedure->name == 'EBUS') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EBUS');
                    $isFluoroscopy = (isset($procedure) && $procedure->name == 'Fluoroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Fluoroscopy');
                    $isFlexibleSigmoidoscopy = (isset($procedure) && $procedure->name == 'Flexible Sigmoidoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Flexible Sigmoidoscopy');
                    $isFlexibleLaryngoscopy = (isset($procedure) && $procedure->name == 'Flexible Laryngoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Flexible Laryngoscopy');
                    $isFlexibleCystoscopy = (isset($procedure) && $procedure->name == 'Flexible Cystoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Flexible Cystoscopy');
                    $isEarEndoscopy = (isset($procedure) && $procedure->name == 'Ear Endoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Ear Endoscopy');
                    $isEsophagealStent = (isset($procedure) && $procedure->name == 'Esophageal Stent') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Esophageal Stent');
                    $isDuodenoscopy = (isset($procedure) && $procedure->name == 'Duodenoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Duodenoscopy');
                    $isPCN = (isset($procedure) && $procedure->name == 'PCN') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'PCN');
                    $isPEG = (isset($procedure) && $procedure->name == 'PEG') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'PEG');
                    $isRP = (isset($procedure) && $procedure->name == 'RP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'RP');
                    $isRigidBronchoscopy = (isset($procedure) && $procedure->name == 'Rigid Bronchoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Rigid Bronchoscopy');
                    $isRetrogradeDBE = (isset($procedure) && $procedure->name == 'Retrograde DBE') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Retrograde DBE');
                    $isPushEnteroscopy = (isset($procedure) && $procedure->name == 'Push Enteroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Push Enteroscopy');
                    $isPOEM = (isset($procedure) && $procedure->name == 'POEM') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'POEM');
                    $isPleuroscopy = (isset($procedure) && $procedure->name == 'Pleuroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Pleuroscopy');
                    $isPercutaneousDilatationalTracheostomy = (isset($procedure) && $procedure->name == 'Percutaneous Dilatational Tracheostomy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Percutaneous Dilatational Tracheostomy');
                    $isNasojejunostomy = (isset($procedure) && $procedure->name == 'Nasojejunostomy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Nasojejunostomy');
                    $isNasalEndoscopy = (isset($procedure) && $procedure->name == 'Nasal Endoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Nasal Endoscopy');
                    $isInsertNJ = (isset($procedure) && $procedure->name == 'Insert NJ') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Insert NJ');
                    $isKneeArthroscopy = (isset($procedure) && $procedure->name == 'Knee Arthroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Knee Arthroscopy');
                    $isKidneyBiopsy = (isset($procedure) && $procedure->name == 'Kidney Biopsy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Kidney Biopsy');
                    $isHipArthroscopy = (isset($procedure) && $procedure->name == 'Hip Arthroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Hip Arthroscopy');
                    $isHandArthroscopy = (isset($procedure) && $procedure->name == 'Hand Arthroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Hand Arthroscopy');
                    $isDoubleBalloonEnteroscopy = (isset($procedure) && $procedure->name == 'Double Balloon Enteroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Double Balloon Enteroscopy');
                    $isCREBalloonDilatation = (isset($procedure) && $procedure->name == 'CRE Balloon Dilatation') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'CRE Balloon Dilatation');
                    $isArthrobrostrom = (isset($procedure) && $procedure->name == 'Arthrobrostrom') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Arthrobrostrom')
                @endphp
                @if($isLongWriting && $isEGD)
                <td style="width: 21%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isArthroscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isEBUS)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isRigidBronchoscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isFlexibleCystoscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                  @elseif($isLongWriting && $isDuodenoscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isHipArthroscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isPushEnteroscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isDoubleBalloonEnteroscopy)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 27px;">
                    <span class="casetitle" style="padding-right: 27px;">PATIENT IN:</span>
                </td>
                  @elseif($isLongWriting && $isCystostomy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isNasojejunostomy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isHandArthroscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isCystogram)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isPCN)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isRP)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isPleuroscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isPercutaneousDilatationalTracheostomy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isNasalEndoscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isFluoroscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isRetrogradeDBE)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                  @elseif($isLongWriting && $isCystowithDJstent)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isFlexibleLaryngoscopy)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 27px;">
                    <span class="casetitle" style="padding-right: 27px;">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isFlexibleSigmoidoscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 27px;">
                    <span class="casetitle" style="padding-right: 27px;">PATIENT IN:</span>
                </td>
                  @elseif($isLongWriting && $isCystowithRP)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                  @elseif($isLongWriting && $isEarEndoscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isChangeDSstent)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 2px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                  @elseif($isLongWriting && $isColonicStent)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 25px;">
                    <span class="casetitle" style="padding-right: 28px;">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isInsertNJ)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 25px;">
                    <span class="casetitle" style="padding-right: 28px;">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isKneeArthroscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 25px;">
                    <span class="casetitle" style="padding-right: 28px;">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isChangejejunostomy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 2px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isCREBalloonDilatation)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isChangePCN)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isBCG)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isColonoscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isArthrobrostrom)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isLaparoscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isFEES)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 27px;">
                    <span class="casetitle" style="padding-right: 27px;">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isKidneyBiopsy)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 27px;">
                    <span class="casetitle" style="padding-right: 27px;">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isManometry)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isPOEM)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 30px;">
                    <span class="casetitle" style="padding-right: 25px;">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isEsophagealStent)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isEnteroscopy)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px !important;">
                    <span class="casetitle" style="padding-right:50px; ">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isAnterogradeDBE)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px !important;">
                    <span class="casetitle" style="padding-right:4px; ">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isApolloEndosurgery)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px !important;">
                    <span class="casetitle" style="padding-right:50px; ">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isLiverBiopsy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isERCP)
                <td style="width: 21%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLongWriting && $isPEG)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                  @elseif($isLongWriting && $isEUS)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isLongWriting && $isBronchoscopy)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 55px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                   @elseif($isLongWriting && $isERP)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 55px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isLaparoscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isERP)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                 @elseif($isPOEM)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 7px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                 @elseif($isPCN)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isRP)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                 @elseif($isRetrogradeDBE)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isPEG)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isRigidBronchoscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isPercutaneousDilatationalTracheostomy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isKidneyBiopsy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isHandArthroscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                 @elseif($isFEES)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isNasojejunostomy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 24px;">
                    <span class="casetitle" style="padding-right: 24px;">PATIENT IN:</span>
                </td>
                 @elseif($isNasalEndoscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isFluoroscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isPushEnteroscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isKneeArthroscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isFlexibleLaryngoscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                  @elseif($isEarEndoscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isEBUS)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isPleuroscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isFlexibleSigmoidoscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                  @elseif($isENT)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                 @elseif($isHipArthroscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isFlexibleCystoscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                  @elseif($isEsophagealStent)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 4px;">
                    <span class="casetitle" style="padding-right: 4px;">PATIENT IN:</span>
                </td>
                @elseif($isCystostomy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isInsertNJ)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isDoubleBalloonEnteroscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                   @elseif($isCystogram)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                   @elseif($isDuodenoscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isCystowithDJstent)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                  @elseif($isCystowithRP)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isChangePCN)
                <td style="width: 42%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                  @elseif($isChangeDSstent)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:11px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isBCG)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isColonicStent)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isManometry)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                   @elseif($isChangejejunostomy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isCREBalloonDilatation)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isArthroscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                  @elseif($isEUS)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:11px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isColonoscopy)
                <td style="width: 43%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @elseif($isEGD)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isERCP)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 10px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isArthrobrostrom)
                <td style="width: 42%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 10px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                   @elseif($isBronchoscopy)
                <td style="width: 39%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 10px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isEnteroscopy)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 10px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isAnterogradeDBE)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 10px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                 @elseif($isApolloEndosurgery)
                <td style="width: 41%; vertical-align: top; white-space: nowrap; padding-top:11px; padding-right: 10px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                  @elseif($isLiverBiopsy)
                <td style="width: 39%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 10px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @else
                <td style="width: 35%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">PATIENT IN:</span>
                </td>
                @endif
                <td style="width: 65%; vertical-align: top;" >
                    @isset($casedata->time_patientin)
                        <span class="casetext" style="padding-left: 1px;">{{$casedata->time_patientin}}</span>
                    @else
                        &nbsp;<span class="casetext">-</span>
                    @endisset
                </td>
            </tr>
        </table>
    </td>
</tr>
