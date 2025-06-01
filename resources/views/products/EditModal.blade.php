<div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form id="editProductForm" action="" method="post">
              {{ method_field('patch') }}
              {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-group">
                      <label for="title">اسم المنتج </label>
                      <input type="hidden" class="form-control" name="id" id="pro_id">
                      <input type="text" class="form-control" name="name" id="Product_name">
                  </div>

                  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                  <select name="section_id" id="section_name" class="custom-select my-1 mr-sm-2">
                      @foreach ($sections as $section)
                          <option value="{{ $section->id }}">{{ $section->name }}</option>
                      @endforeach
                  </select>

                  <div class="form-group">
                      <label for="des">ملاحظات :</label>
                      <textarea name="description" cols="20" rows="5" id='description'
                          class="form-control"></textarea>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
              </div>
          </form>
      </div>
  </div>
</div>
