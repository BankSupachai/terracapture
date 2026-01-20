# การวิเคราะห์และแผนการแก้ไข: ยกเลิกการใช้ PHP โดยตรงใน Blade และเปลี่ยนเป็น API

**วันที่:** 2025-12-22  
**ไฟล์หลัก:** `resources/views/capture/camera/obs/01obs.blade.php`  
**Controller เป้าหมาย:** `app/Http/Controllers/api/captureController.php`

---

## 1. ไฟล์ที่เกี่ยวข้อง

### 1.1 ไฟล์หลัก (Main File)
- `resources/views/capture/camera/obs/01obs.blade.php` - ไฟล์หลักที่ต้องการแก้ไข

### 1.2 ไฟล์ที่ถูก Include (Included Files)
ไฟล์ต่อไปนี้ถูก include ใน `01obs.blade.php` และอาจมีการใช้ PHP โดยตรง:

#### Modal Files
- `resources/views/capture/camera/modal/modal_scope_alert.blade.php`
- `resources/views/capture/camera/mockup/livestream_modal.blade.php`
- `resources/views/capture/camera/mockup/medi_modal.blade.php`
- `resources/views/capture/camera/modal/modal_signal_lost.blade.php`
- `resources/views/capture/camera/modal/modal_sms.blade.php`
- `resources/views/capture/camera/modal/modal_new_case.blade.php`
- `resources/views/capture/camera/modal/modal_progress_camera.blade.php`
- `resources/views/capture/camera/modal/modal_casetest.blade.php`
- `resources/views/capture/camera/modal/attendant.blade.php`
- `resources/views/capture/camera/modal/modal_livestream.blade.php`
- `resources/views/capture/camera/modal/modal_socket5restart.blade.php`

#### OBS Component Files
- `resources/views/capture/camera/obs/js_socket.blade.php`
- `resources/views/capture/camera/obs/js_onload.blade.php`
- `resources/views/capture/camera/obs/js_hotkey.blade.php`
- `resources/views/capture/camera/obs/js_checksignal.blade.php`
- `resources/views/capture/camera/obs/div_left.blade.php`
- `resources/views/capture/camera/obs/captureandvdocontrol.blade.php`
- `resources/views/capture/camera/obs/btncontrol.blade.php`
- `resources/views/capture/camera/obs/manage_camera.blade.php`
- `resources/views/capture/camera/obs/mainscript.blade.php`

### 1.3 Controller Files
- `app/Http/Controllers/api/captureController.php` - API Controller เป้าหมาย
- `routes/api.php` - Route definition (ใช้ `Route::resource("camera", ...)`)

---

## 2. การเรียกใช้ PHP โดยตรงที่พบใน Blade Files

### 2.1 ในไฟล์ `01obs.blade.php`

#### 2.1.1 Blade Directives
```php
{{ bladelink('capture/camera/obs/01obs') }}
{{ csrf_token() }}
{{ url('...') }}
{{ asset('...') }}
{{ $cid }}
```

#### 2.1.2 JavaScript ที่ฝัง PHP
```javascript
// บรรทัด 100-105
function case_update(key, value) {
    $.post("{{ url('api/capture') }}", {
        event: 'case_update',
        key: key,
        value: value,
        cid: '{{ $cid }}'
    }, function(d,s) {});
}
```

### 2.2 ในไฟล์ `div_left.blade.php`

#### 2.2.1 @php Directives (การใช้ PHP โดยตรง)
```php
// บรรทัด 10-12
@php
    $this_name = $case->procedurename ?? 'TEST CAMERA';
@endphp

// บรรทัด 24-30
@php
    $gender = match ($patient['gender'] ?? null) {
        '1' => 'Male',
        '2' => 'Female',
        default => $patient['gender'] ?? '-',
    };
@endphp
```

#### 2.2.2 การใช้ Helper Functions
```php
{{ age(@$patient['birthdate']) }}  // บรรทัด 34
{{ @$patient['hn'] }}              // บรรทัด 14
{{ @$patient['firstname'] }}        // บรรทัด 21
{{ @$case->doctorname }}            // บรรทัด 42
{{ @$this_room }}                   // บรรทัด 50
{{ count($imgall) }}                // บรรทัด 86
```

#### 2.2.3 @foreach Loop
```php
@foreach ($imgall as $val)  // บรรทัด 89
    // ...
@endforeach
```

#### 2.2.4 JavaScript ที่ฝัง PHP
```javascript
// บรรทัด 102-109
function change_doctor(doctor_id) {
    $.post("{{ url('api/capture') }}", {
        event: 'set_doctorname',
        key: 'doctorname',
        value: doctor_id,
        cid: '{{ $cid }}'
    }, function(data) {
        $("#text_doctorname").html(data);
    });
}
```

### 2.3 ในไฟล์ `captureandvdocontrol.blade.php`

#### 2.3.1 @foreach Loop
```php
@foreach ($scope ?? [] as $s)  // บรรทัด 6
    <option value="{{ $s->scope_id }}" @selected($s->scope_id == @$this_scope[0])>
        {{ $s->scope_name }} ({{ $s->scope_serial }})
    </option>
@endforeach
```

#### 2.3.2 การใช้ Helper Functions
```php
{{ @uid() }}                     // บรรทัด 61
{{ @$cid }}                      // บรรทัด 74
{{ @$case->case_hn }}            // บรรทัด 145
{{ @$case->department }}         // บรรทัด 146
{{ domainname('ScreenRecord') }} // บรรทัด 194
```

#### 2.3.3 @if Directive
```php
@if (@$camera->firstimg_starttime)  // บรรทัด 199
    if (new_num == 1) $('#btn_time_start').trigger('click');
@endif
```

#### 2.3.4 JavaScript ที่ฝัง PHP
```javascript
// บรรทัด 58-62
$.post("{{ url('api/capture') }}", {
    event: "scopetracking",
    val: tempscopeselect_name,
    uid: "{{ @uid() }}"
});

// บรรทัด 71-78
$.post('{{ url('api/jquery') }}', {
    event: "update_scope",
    scope: scope_id,
    cid: "{{ @$cid }}",
    source: source
}, function(data) {
    $("#change_camera").val(data);
});
```

### 2.4 ในไฟล์ `attendant.blade.php`

#### 2.4.1 @php Directive (การใช้ PHP โดยตรง)
```php
// บรรทัด 9-11
@php
    use App\Models\Mongo;
@endphp

// บรรทัด 100-103
@php
    $data = intval($data);
    $tb_user = Mongo::table('users')->where('uid', $data)->first();
@endphp
```

#### 2.4.2 @foreach Loops
```php
@foreach ($doctor ?? [] as $d)           // บรรทัด 19
@foreach ($room ?? [] as $r)             // บรรทัด 32
@foreach ($doctor ?? [] as $data)         // บรรทัด 57
@foreach ($nurse ?? [] as $data)          // บรรทัด 70
@foreach ($nurse_assistant ?? [] as $data) // บรรทัด 83
@foreach ($case->user_in_case ?? [] as $data) // บรรทัด 99
```

#### 2.4.3 การใช้ Helper Functions
```php
{{ fullname($d) }}        // บรรทัด 21
{{ fullname(@$data) }}    // บรรทัด 58, 71, 84, 105
{{ @$d->uid }}            // บรรทัด 20
{{ @$case->case_physicians01 }} // บรรทัด 20
{{ @$case->case_room }}   // บรรทัด 33
{{ @$tb_user->uid }}      // บรรทัด 108
```

#### 2.4.4 JavaScript ที่ฝัง PHP
```javascript
// บรรทัด 147-153
$.post('{{ url('api/capture') }}', {
    event: 'attendant_update',
    data_id: data_id,
    cid: '{{ $cid }}'
}, function(data, status) {
    load_userincase();
});

// บรรทัด 162-167
$.post('{{ url('api/capture') }}', {
    event: 'load_userincase',
    cid: '{{ $cid }}',
}, function(data, status) {
    $("#load_userincase").html(data);
});
```

### 2.5 ในไฟล์ `js_socket.blade.php`

#### 2.5.1 การใช้ Helper Functions
```php
{{ @$config->com_name }}              // บรรทัด 6
{{ @$olympus_disabled }}               // บรรทัด 55
{{ @$olympus_picname }}                // บรรทัด 55
{{ @$fuji_picname }}                   // บรรทัด 56
{{ @$ocr_img }}                        // บรรทัด 57
{{ @$hn }}                             // บรรทัด 57
{{ @$cid }}                            // บรรทัด 63
{{ date('dHis') }}                     // บรรทัด 74
{{ url("camera/$cid/edit") }}          // บรรทัด 88
{{ $cid }}                              // บรรทัด 91
{{ @$case->case_hn }}                  // บรรทัด 91
{{ @$case->procedurename }}            // บรรทัด 91
{{ @$case->department }}               // บรรทัด 91
{{ @$cid }}                            // บรรทัด 121
{{ @$cid }}                            // บรรทัด 122
{{ @$cid }}                            // บรรทัด 130
{{ @$caseuniq }}                       // บรรทัด 131
{{ @$feature->photocaseuniq }}         // บรรทัด 132
{{ @$feature->liveconsult }}           // บรรทัด 138
```

### 2.6 ในไฟล์ `js_onload.blade.php`

#### 2.6.1 การใช้ Helper Functions
```php
{{ domainnameport(':3000') }}           // บรรทัด 29
{{ domainname('config/sound/...') }}    // บรรทัด 39-41
{{ @$scope_serial }}                   // บรรทัด 34 (ใช้ @json)
{{ @$case->appointment }}              // บรรทัด 53
{{ $cid }}                              // บรรทัด 56
{{ $hn }}                               // บรรทัด 56
{{ @$case->procedurename }}            // บรรทัด 56
{{ @$case->caseuniq }}                 // บรรทัด 56
{{ $url }}                              // บรรทัด 61
```

#### 2.6.2 @if Directive
```php
@if ($type == 'test')  // บรรทัด 42
    // ...
@endif
```

### 2.7 ในไฟล์ `mainscript.blade.php`

#### 2.7.1 @if Directive
```php
@if (@$camera->force_select)  // บรรทัด 10
    // ...
@endif
```

### 2.8 ในไฟล์ `btncontrol.blade.php`

#### 2.8.1 Form ที่ใช้ PHP
```php
// บรรทัด 21-28
<form id="finish_record" action="{{ url('camera') }}" method="post">
    @csrf
    <input name="event" value="finish_record" type="hidden">
    <input name="hn" value="{{ $hn }}" type="hidden">
    <input name="cid" value="{{ $cid }}" type="hidden">
    <input name="caseuniq" value="{{ $case->caseuniq }}" type="hidden">
    <button type="submit">save</button>
</form>
```

#### 2.8.2 JavaScript ที่ฝัง PHP
```javascript
// บรรทัด 35-39
$.post("{{ url('api/capture') }}", {
    event: "back2home",
    cid: "{{ $cid }}",
    hn: "{{ $hn }}"
});
```

### 2.9 ในไฟล์ `manage_camera.blade.php`

#### 2.9.1 การใช้ PHP Variables
```php
{{ $drive_color }}  // บรรทัด 32
{{ $persen }}       // บรรทัด 33, 36
{{ $ds }}           // บรรทัด 36
{{ $drive }}        // บรรทัด 36
```

---

## 3. สรุปการเรียกใช้ PHP โดยตรงที่ต้องแก้ไข

### 3.1 ประเภทการเรียกใช้ PHP ที่พบ

#### A. Blade Directives (ไม่ต้องแก้ไข - เป็นมาตรฐานของ Blade)
- `{{ }}` - Echo variables
- `@if`, `@endif` - Conditional statements
- `@foreach`, `@endforeach` - Loops
- `@include` - Include files
- `@csrf` - CSRF token

#### B. PHP Code Blocks (ต้องแก้ไข - ย้ายไป API)
- `@php ... @endphp` - Direct PHP code execution
  - ใน `div_left.blade.php` (บรรทัด 10-12, 24-30)
  - ใน `attendant.blade.php` (บรรทัด 9-11, 100-103)

#### C. Helper Functions (ต้องแก้ไข - ย้ายไป API)
- `age()` - คำนวณอายุ
- `fullname()` - แสดงชื่อเต็ม
- `uid()` - ดึง User ID
- `domainname()` - ดึง domain name
- `domainnameport()` - ดึง domain name พร้อม port
- `bladelink()` - Generate blade link
- `getCONFIG()` - ดึง config (ใช้ใน controller)
- `Mongo::table()` - Query MongoDB (ใช้ใน blade)
- `SERVER::table()` - Query Server DB (ใช้ใน controller)

#### D. Database Queries ใน Blade (ต้องแก้ไข - ย้ายไป API)
- `Mongo::table('users')->where('uid', $data)->first()` ใน `attendant.blade.php`

#### E. JavaScript ที่ฝัง PHP Variables (ต้องแก้ไข - ใช้ API)
- การส่ง `$cid`, `$hn`, `$case->*` ผ่าน JavaScript
- ควรดึงข้อมูลผ่าน API แทน

---

## 4. API Endpoints ที่มีอยู่ใน CameraController

### 4.1 Methods ที่มีอยู่แล้วใน CameraController

1. **load_userincase($r)**
   - รับ: `cid`
   - ส่งคืน: HTML string ของ user list
   - ใช้ใน: `attendant.blade.php`

2. **case_update($r)**
   - รับ: `key`, `value`, `cid`
   - อัปเดต: `tb_case` collection
   - ใช้ใน: `01obs.blade.php`, `attendant.blade.php`

3. **attendant_update($r)**
   - รับ: `data_id`, `cid`
   - อัปเดต: `user_in_case` array ใน `tb_case`
   - ส่งคืน: JSON array
   - ใช้ใน: `attendant.blade.php`

4. **update_tb_case($r)**
   - รับ: `cid`, `user_id[]`
   - อัปเดต: `user_in_case` array
   - ส่งคืน: JSON array

5. **delete_user_in_case($r)**
   - รับ: `id`, `cid`
   - ลบ: user จาก `user_in_case`
   - ส่งคืน: JSON array

6. **back2home($r)**
   - รับ: `cid`, `hn`, `caseuniq`
   - ทำงาน: จัดการ case เมื่อกลับหน้า home
   - ใช้ใน: `btncontrol.blade.php`

7. **scopetracking($r)**
   - รับ: `val` (scope_id), `uid`
   - บันทึก: tracking information
   - ใช้ใน: `captureandvdocontrol.blade.php`

8. **set_lumina_config($r)**
   - รับ: `_id`
   - อัปเดต: `tb_lumina` collection
   - ส่งคืน: JSON string

9. **recorder_action($r)**
   - รับ: `cid`, `type`, `config`
   - อัปเดต: case status และ lumina config

10. **set_data_config($r)**
    - รับ: `data` (array)
    - อัปเดต: `tb_lumina` collection
    - ส่งคืน: JSON encoded case

11. **set_marker_height($r)**
    - รับ: `height`
    - อัปเดต: config

12. **set_doctorname($r)**
    - รับ: `value` (user_id), `cid`
    - อัปเดต: `doctorname` และ `case_physicians01`
    - ส่งคืน: doctorname string
    - ใช้ใน: `div_left.blade.php`

### 4.2 API Endpoint Structure

จาก `routes/api.php`:
```php
Route::resource("camera", App\Http\Controllers\Api\CameraController::class);
```

Laravel Resource Controller จะสร้าง routes:
- `POST /api/capture` → `store()` method
- `GET /api/capture` → `index()` method
- `GET /api/capture/{id}` → `show()` method
- `PUT/PATCH /api/capture/{id}` → `update()` method
- `DELETE /api/capture/{id}` → `destroy()` method

**หมายเหตุ:** `CameraController` **ไม่มี `store()` method** ดังนั้นต้องเพิ่ม method นี้เพื่อจัดการ POST requests ที่มี `event` parameter

---

## 5. แผนการแก้ไข

### 5.1 เพิ่ม store() Method ใน CameraController

```php
public function store(Request $r)
{
    if (isset($r->event)) {
        $event = $r->event;
        if (method_exists($this, $event)) {
            return $this->$event($r);
        }
    }
    return response()->json(['error' => 'Invalid event'], 400);
}
```

### 5.2 สร้าง API Endpoints ใหม่สำหรับข้อมูลที่ต้องการ

#### 5.2.1 API สำหรับดึงข้อมูล Patient
**Endpoint:** `GET /api/capture/patient/{cid}` หรือ `POST /api/capture` with `event: 'get_patient'`

**Response:**
```json
{
    "hn": "...",
    "firstname": "...",
    "middlename": "...",
    "lastname": "...",
    "gender": "...",
    "birthdate": "...",
    "age": "..."
}
```

#### 5.2.2 API สำหรับดึงข้อมูล Case
**Endpoint:** `GET /api/capture/case/{cid}` หรือ `POST /api/capture` with `event: 'get_case'`

**Response:**
```json
{
    "cid": "...",
    "caseuniq": "...",
    "procedurename": "...",
    "doctorname": "...",
    "case_hn": "...",
    "department": "...",
    "appointment": "...",
    "case_room": "...",
    "user_in_case": [...]
}
```

#### 5.2.3 API สำหรับดึงข้อมูล Scope List
**Endpoint:** `GET /api/capture/scopes` หรือ `POST /api/capture` with `event: 'get_scopes'`

**Response:**
```json
[
    {
        "scope_id": 1,
        "scope_name": "...",
        "scope_serial": "..."
    }
]
```

#### 5.2.4 API สำหรับดึงข้อมูล Doctor/Nurse Lists
**Endpoint:** `GET /api/capture/users?type=doctor` หรือ `POST /api/capture` with `event: 'get_users'`

**Response:**
```json
[
    {
        "uid": 1,
        "user_prefix": "...",
        "user_firstname": "...",
        "user_lastname": "...",
        "user_code": "...",
        "fullname": "..."
    }
]
```

#### 5.2.5 API สำหรับดึงข้อมูล Room List
**Endpoint:** `GET /api/capture/rooms` หรือ `POST /api/capture` with `event: 'get_rooms'`

**Response:**
```json
[
    {
        "room_id": 1,
        "room_name": "..."
    }
]
```

#### 5.2.6 API สำหรับดึงข้อมูล Images
**Endpoint:** `GET /api/capture/images/{cid}` หรือ `POST /api/capture` with `event: 'get_images'`

**Response:**
```json
[
    {
        "img": "...",
        "num": 1
    }
]
```

#### 5.2.7 API สำหรับดึงข้อมูล Config
**Endpoint:** `GET /api/capture/config` หรือ `POST /api/capture` with `event: 'get_config'`

**Response:**
```json
{
    "com_name": "...",
    "olympus_disabled": "...",
    "olympus_picname": "...",
    "fuji_picname": "...",
    "ocr_img": "...",
    "camera": {
        "force_select": true,
        "firstimg_starttime": true
    },
    "scope_serial": [...],
    "feature": {
        "photocaseuniq": false,
        "liveconsult": false
    }
}
```

### 5.3 แก้ไข Blade Files

#### 5.3.1 ไฟล์ `01obs.blade.php`
- **ลบ:** การฝัง `$cid` ใน JavaScript
- **เปลี่ยนเป็น:** ดึง `cid` จาก API หรือส่งผ่าน data attribute

#### 5.3.2 ไฟล์ `div_left.blade.php`
- **ลบ:** `@php` blocks (บรรทัด 10-12, 24-30)
- **ลบ:** `{{ age(@$patient['birthdate']) }}`
- **เปลี่ยนเป็น:** ดึงข้อมูลผ่าน API และแสดงผลด้วย JavaScript
- **ลบ:** `@foreach ($imgall as $val)`
- **เปลี่ยนเป็น:** ดึง images ผ่าน API และ render ด้วย JavaScript

#### 5.3.3 ไฟล์ `captureandvdocontrol.blade.php`
- **ลบ:** `@foreach ($scope ?? [] as $s)`
- **เปลี่ยนเป็น:** ดึง scope list ผ่าน API และ populate ด้วย JavaScript
- **ลบ:** การฝัง PHP variables ใน JavaScript
- **เปลี่ยนเป็น:** ดึงข้อมูลผ่าน API

#### 5.3.4 ไฟล์ `attendant.blade.php`
- **ลบ:** `@php use App\Models\Mongo; @endphp`
- **ลบ:** `@php` block ที่ query database (บรรทัด 100-103)
- **ลบ:** `@foreach` loops ทั้งหมด
- **เปลี่ยนเป็น:** ดึงข้อมูลผ่าน API และ render ด้วย JavaScript
- **ลบ:** `{{ fullname() }}` calls
- **เปลี่ยนเป็น:** API ส่ง fullname มาให้แล้ว

#### 5.3.5 ไฟล์ `js_socket.blade.php`
- **ลบ:** การฝัง PHP variables ใน JavaScript
- **เปลี่ยนเป็น:** ดึงข้อมูลผ่าน API หรือส่งผ่าน data attributes

#### 5.3.6 ไฟล์ `js_onload.blade.php`
- **ลบ:** การฝัง PHP variables ใน JavaScript
- **เปลี่ยนเป็น:** ดึงข้อมูลผ่าน API

#### 5.3.7 ไฟล์ `btncontrol.blade.php`
- **ลบ:** Form submission ที่ใช้ PHP
- **เปลี่ยนเป็น:** ใช้ API call แทน

#### 5.3.8 ไฟล์ `manage_camera.blade.php`
- **ลบ:** การใช้ PHP variables โดยตรง
- **เปลี่ยนเป็น:** ดึงข้อมูลผ่าน API

### 5.4 สร้าง JavaScript Helper Functions

สร้างไฟล์ JavaScript สำหรับจัดการ API calls:

```javascript
// assets/js/camera-api.js
const CameraAPI = {
    baseUrl: '/api/capture',
    
    async getPatient(cid) {
        const response = await fetch(`${this.baseUrl}/patient/${cid}`);
        return await response.json();
    },
    
    async getCase(cid) {
        const response = await fetch(`${this.baseUrl}/case/${cid}`);
        return await response.json();
    },
    
    async getScopes() {
        const response = await fetch(`${this.baseUrl}/scopes`);
        return await response.json();
    },
    
    async getUsers(type) {
        const response = await fetch(`${this.baseUrl}/users?type=${type}`);
        return await response.json();
    },
    
    async getRooms() {
        const response = await fetch(`${this.baseUrl}/rooms`);
        return await response.json();
    },
    
    async getImages(cid) {
        const response = await fetch(`${this.baseUrl}/images/${cid}`);
        return await response.json();
    },
    
    async getConfig() {
        const response = await fetch(`${this.baseUrl}/config`);
        return await response.json();
    },
    
    async caseUpdate(cid, key, value) {
        const response = await fetch(this.baseUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                event: 'case_update',
                cid: cid,
                key: key,
                value: value
            })
        });
        return await response.json();
    },
    
    // ... methods อื่นๆ
};
```

### 5.5 ตัวอย่างการแก้ไข

#### Before (div_left.blade.php):
```php
@php
    $this_name = $case->procedurename ?? 'TEST CAMERA';
@endphp
<span class="h3 text-white">{{ $this_name }}</span>
<span class="align-self-center fs-14 fw-light text-white">HN : {{ @$patient['hn'] }}</span>
```

#### After (div_left.blade.php):
```html
<span class="h3 text-white" id="procedure_name">Loading...</span>
<span class="align-self-center fs-14 fw-light text-white">HN : <span id="patient_hn">Loading...</span></span>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    const cid = document.querySelector('[data-cid]').dataset.cid;
    const caseData = await CameraAPI.getCase(cid);
    const patientData = await CameraAPI.getPatient(cid);
    
    document.getElementById('procedure_name').textContent = caseData.procedurename || 'TEST CAMERA';
    document.getElementById('patient_hn').textContent = patientData.hn || '';
});
</script>
```

---

## 6. ขั้นตอนการดำเนินการ

### Phase 1: เตรียม API Endpoints
1. เพิ่ม `store()` method ใน `CameraController`
2. สร้าง methods ใหม่สำหรับดึงข้อมูล:
   - `get_patient($r)`
   - `get_case($r)`
   - `get_scopes($r)`
   - `get_users($r)`
   - `get_rooms($r)`
   - `get_images($r)`
   - `get_config($r)`

### Phase 2: สร้าง JavaScript Helper
1. สร้างไฟล์ `assets/js/camera-api.js`
2. สร้าง CameraAPI object พร้อม methods

### Phase 3: แก้ไข Blade Files
1. แก้ไข `01obs.blade.php` - เพิ่ม data attributes และ load JavaScript
2. แก้ไข `div_left.blade.php` - ลบ PHP blocks, ใช้ API
3. แก้ไข `captureandvdocontrol.blade.php` - ใช้ API สำหรับ scope list
4. แก้ไข `attendant.blade.php` - ใช้ API สำหรับ user lists
5. แก้ไข `js_socket.blade.php` - ใช้ API สำหรับ config
6. แก้ไข `js_onload.blade.php` - ใช้ API สำหรับ initial data
7. แก้ไข `btncontrol.blade.php` - ใช้ API แทน form submission
8. แก้ไข `manage_camera.blade.php` - ใช้ API สำหรับ storage info

### Phase 4: Testing
1. ทดสอบการโหลดข้อมูลผ่าน API
2. ทดสอบการอัปเดตข้อมูลผ่าน API
3. ทดสอบ UI/UX ว่ายังทำงานเหมือนเดิม

### Phase 5: Cleanup
1. ลบ PHP code ที่ไม่ใช้แล้ว
2. ลบ helper functions ที่ไม่จำเป็น (ถ้ามี)
3. อัปเดต documentation

---

## 7. ข้อควรระวัง

1. **Performance:** การดึงข้อมูลหลาย API calls อาจช้ากว่าเดิม ควรพิจารณาใช้ batch API หรือ single endpoint ที่ส่งข้อมูลทั้งหมดมา
2. **Error Handling:** ต้องจัดการ error cases เมื่อ API call ล้มเหลว
3. **Loading States:** ต้องแสดง loading indicators ขณะดึงข้อมูล
4. **Backward Compatibility:** ต้องตรวจสอบว่ายังทำงานกับ code ส่วนอื่นที่อาจเรียกใช้ blade files เหล่านี้
5. **CSRF Token:** ต้องแน่ใจว่า API calls ที่เป็น POST/PUT/DELETE มี CSRF token
6. **Data Attributes:** ใช้ data attributes เพื่อส่งข้อมูลที่จำเป็น (เช่น `cid`) จาก server ไปยัง client

---

## 8. ไฟล์ที่ต้องแก้ไขสรุป

### 8.1 Controller Files
- `app/Http/Controllers/api/captureController.php` - เพิ่ม methods ใหม่

### 8.2 View Files (Blade)
- `resources/views/capture/camera/obs/01obs.blade.php`
- `resources/views/capture/camera/obs/div_left.blade.php`
- `resources/views/capture/camera/obs/captureandvdocontrol.blade.php`
- `resources/views/capture/camera/obs/attendant.blade.php`
- `resources/views/capture/camera/obs/js_socket.blade.php`
- `resources/views/capture/camera/obs/js_onload.blade.php`
- `resources/views/capture/camera/obs/btncontrol.blade.php`
- `resources/views/capture/camera/obs/manage_camera.blade.php`
- `resources/views/capture/camera/obs/mainscript.blade.php`

### 8.3 JavaScript Files (ใหม่)
- `assets/js/camera-api.js` - สร้างใหม่

---

## 9. สรุป

การแก้ไขนี้จะทำให้:
- ✅ Blade files ไม่มี PHP code โดยตรง (ยกเว้น Blade directives มาตรฐาน)
- ✅ Logic ทั้งหมดอยู่ใน Controller/API
- ✅ Frontend และ Backend แยกกันชัดเจน
- ✅ ง่ายต่อการ maintain และ test
- ✅ สามารถ reuse API endpoints ได้ในที่อื่น

