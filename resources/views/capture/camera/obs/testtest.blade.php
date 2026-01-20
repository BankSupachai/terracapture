<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">

<select class="selectpicker form-control" multiple data-live-search="true"
        title="เลือกประเทศ" data-size="5" data-actions-box="true">
    <option value="th">Thailand</option>
    <option value="cn">China</option>
    <option value="jp">Japan</option>
    <option value="us">United States</option>
    <option value="uk">United Kingdom</option>
</select>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>

<script>
    $(function() {
        $('.selectpicker').selectpicker();
    });
</script>
