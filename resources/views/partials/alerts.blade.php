@if(session('success'))
    <div class="alert alert-success">عملیات با موفقیت انجام شد</div>
@elseif(session('failed'))
    <div class="alert alert-danger">عملیات با شکست مواجه شد</div>
@elseif(session('registered'))
    <div class="alert alert-success">ثبت نام با موفقیت انجام شد</div>
@endif
