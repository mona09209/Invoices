@if(session()->has('add'))
    <div class="alert alert-success">
        {{ session('add') }}
    </div>

@endif

@if(session()->has('add_user'))
    <div class="alert alert-success">
        {{ session('add_user') }}
    </div>
@endif
@if(session()->has('update_user'))
    <div class="alert alert-success">
        {{ session('update_user') }}
    </div>
@endif

@if(session()->has('delete_user'))
    <div class="alert alert-success">
        {{ session('delete_user') }}
    </div>
@endif
@if(session()->has('add_role'))
    <div class="alert alert-success">
        {{ session('add_role') }}
    </div>
@endif
@if(session()->has('update_role'))
    <div class="alert alert-success">
        {{ session('update_role') }}
    </div>
@endif

@if(session()->has('delete_role'))
    <div class="alert alert-success">
        {{ session('delete_role') }}
    </div>
@endif

@if(session()->has('edit'))
    <div class="alert alert-success">
        {{ session('edit') }}
    </div>
@endif

@if(session()->has('delete'))
    <div class="alert alert-success">
        {{ session('delete') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>

@endif

@if (session()->has('delete_invoice'))
<script>
    window.onload = function() {
        notif({
            msg: "تم حذف الفاتورة بنجاح",
            type: "success"
        })
    }

</script>
@endif

@if (session()->has('archive_invoice'))
<script>
    window.onload = function() {
        notif({
            msg: "تم أرشفة الفاتورة بنجاح",
            type: "success"
        })
    }

</script>
@endif


@if (session()->has('status_update'))
<script>
    window.onload = function() {
        notif({
            msg: "تم تحديث حالة الدفع بنجاح",
            type: "success"
        })
    }

</script>
@endif

@if (session()->has('restore_invoice'))
<script>
    window.onload = function() {
        notif({
            msg: "تم استعادة الفاتورة بنجاح",
            type: "success"
        })
    }

</script>
@endif


@if (session()->has('Add'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم اضافة الصلاحية بنجاح",
                type: "success"
            });
        }

    </script>
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم تحديث بيانات الصلاحية بنجاح",
                type: "success"
            });
        }

    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم حذف الصلاحية بنجاح",
                type: "error"
            });
        }

    </script>
@endif
