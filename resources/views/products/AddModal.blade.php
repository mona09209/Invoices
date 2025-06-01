<!-- Modal effects -->
<div class="modal" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">إضافة منتج </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

     <form action="{{ route('Products.store') }}" method="post" autocomplete="off">
        {{ csrf_field() }}

<div class="form-group">
    <label for="section_name" >إسم المنتج</label>
<input type="text" class="form-control"  id="section_name" name="name" required>
@error('name')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>

<div class="form-group">
    <label for="section_id">اسم القسم</label>
    <select name="section_id" id="section_id" class="form-control" required>
        <option value="" selected disabled>--حدد القسم--</option>
        @foreach ($sections as $section)
            <option value="{{ $section->id }}">{{ $section->name }}</option>
        @endforeach
    </select>
    @error('section_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="description"> ملاحظات</label>
<textarea type="text" class="form-control"  id="description" name="description" rows="3"></textarea>
@error('description')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn ripple btn-success" type="button">حفظ</button>
                <button type="button" class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->
