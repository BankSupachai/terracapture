<style>
      .header-green {
            background-color: #00B8A9;
            color: white;
            padding: 15px;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-green {
            background-color: #00B8A9;
            color: white;
            width: 100%;
            padding: 10px;
            border: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .btn-green:hover {
            background-color: #009B8E;
            color: white;
        }

        .queue-count {
            font-size: 27px;
            text-align: center;
            margin: 20px 0;
            color: #333;
        }
</style>

<div class="row mt-2">
    <div class="col-12" style="display: none;">
        <div class="row">
            <div class="col-6 mb-2">
                <div class="card mb-0">
                    <div class="card-body" style="height: 327px;">
                        <div class="col-12">
                            <div class="header-green">
                                Queue Call - รอทำหัตถการ (จำนวนที่รอ : 10)
                                <i class="ri-menu-line"></i>
                            </div>

                            <div class="queue-count" style="margin-top: 66px; margin-bottom: 66px;">
                                จำนวนที่รอ : 10
                            </div>

                            <button class="btn-green" style="width: 95%; margin: auto;">
                                <i class="ri-arrow-right-line "></i>
                                เรียกคิวรอทำนัดหมาย
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-2">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="h5 ">Noted</div>
                        <div class="col-lg-12">
                            <div class="col-12">
                                {{-- <textarea name="" class="form-control" placeholder="Freetext" id="nurse_monitor_freetext" rows="10">{{ $writeboard }}</textarea> --}}
                                <textarea name="" class="form-control " placeholder="Freetext" id="nurse_monitor_freetext" rows="10">{{ $writeboard }}</textarea>
                            </div>
                            <div class="col-12 text-center mt-3">
                                <button id="monitor_update" class="btn btn-primary  monitor_update w-50"><i
                                        class="ri-refresh-line"></i>
                                    Update to Monitor</button>
                                {{-- <button class="btn btn-success  " data-bs-toggle="modal" data-bs-target="#changely_TV">Custom Layout &ensp;<i class="ri-settings-5-line"></i> </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
