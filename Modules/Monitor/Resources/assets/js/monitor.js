const JSMONITOR = {
    init() {
        this.activeTab()
        this.addHeader()
        this.closeGroupPayload()
        this.removeHeader()
        this.addHtml()
        this.addAnd()
        this.removeAddAnd()
    },
    activeTab() {
        let $tab = $('.js-tab');
        $('.js-tab a').click(function (e) {
            e.preventDefault();
            let $this = $(this), $ele_show = $this.attr('href');
            $tab.removeClass('active');
            $this.parent().addClass('active');
            $('.js-tab-block').hide();
            $($ele_show).show();
        })
    },

    renderHtml(index) {
        let html = '';
        html += `
       <div class="js-payload-and">
           <div  style="border:1px solid #d2d6de;padding: 10px 30px;position: relative" class="form-group   ">
               <button class="btn-close-group-payload" style="position: absolute;left: -10px" ><span>X</span></button>
               <label for="">And rule</label>
               <table class="js-table-add-and table table-sm table-striped m-b-0">
                   <thead style="width: 100%">
                   <tr>
                       <th>Key</th>
                       <th>Condition</th>
                       <th>Value</th>
                       <th></th>
                   </tr>
                   </thead>
                   <tbody class="js-array-row">
                   <tr class="js-row-add-and">
                       <td>
                           <input name="payload_rule[${index}][0][name]" type="text" class="form-control">
                       </td>
                       <td>
                           <input name="payload_rule[${index}][0][condition]" type="text" class="form-control">
                       </td>
                       <td>
                           <input name="payload_rule[${index}][0][value]" type="text" class="form-control">
                       </td>
                       <td>
                           <button class="btn btn-danger btn-sm js-remove-add-and"><i class="fa fa-trash"></i></button>
                       </td>
                   </tr>
                   </tbody>
               </table>
               <div class="">
                   <button type="button" style="margin-left: 5px" class="btn-default btn btn-sm js-add-and" data-index="${index}"> <i class="fa fa-plus"></i> Add and</button>
               </div>
           </div>
       </div>
      `;

        return html;
    },

    addHtml() {
        let that = this;
        $('.js-payload-group').append(this.renderHtml(0));
        $('#btn-add-group-payload').on('click', function (e) {
            e.preventDefault()
            $('.js-payload-group').append(that.renderHtml($('.js-payload-group').children().length))
        })
    },

    addHeader() {
        let that = this;
        $(document).on('click', '.js-add-header', function (e) {
            e.preventDefault()
            let index = $(this).closest(".form-group").find("tbody tr").length;
            let html = that.renderAddHeader(index)
            $(this).closest(".form-group").find("tbody").append(html);
        })
    },

    renderAddHeader(index) {
        let html = `
       <tr class="js-add-tr">
                                    <td>
                                        <input name="additional_headers[${index}][name]" class="form-control" type="text">
                                    </td>
                                    <td>
                                        <input name="additional_headers[${index}][content]" class="form-control" type="text">
                                    </td>
                                    <td class="" style="align-items: center;text-align: center">
                                        <button type="button" class="btn btn-sm js-remove-header btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
      `;

        return html;
    },

    closeGroupPayload() {
        $('.btn-close-group-payload').on('click', function (e) {
            e.preventDefault();
            $(this).parent().remove();
        })
    },


    removeHeader() {
        $(document).on('click','.js-remove-header', function (e) {
            e.preventDefault();
            $(this).closest(".js-add-tr").remove()
        })
    },

    addAnd() {
        let that = this;
        $(document).on('click', '.js-add-and', function (e) {
            e.preventDefault()
            let indexParent = $(this).attr('data-index');
            let indexChild = $(this).closest(".form-group").find("tbody tr").length;
            let html = that.renderHtmlAddEnd(indexParent, indexChild);
            $(this).closest(".form-group").find("tbody").append(html);
        })
    },

    renderHtmlAddEnd(indexParent, indexChild) {
        let html = `
        <tr class="js-row-add-and">
           <td>
               <input name="payload_rule[${indexParent}][${indexChild}][name]" type="text" class="form-control">
           </td>
           <td>
               <input name="payload_rule[${indexParent}][${indexChild}][condition]" type="text" class="form-control">
           </td>
           <td>
               <input name="payload_rule[${indexParent}][${indexChild}][value]" type="text" class="form-control">
           </td>
           <td>
               <button type="button" class="btn btn-sm btn-danger js-remove-add-and"><i class="fa fa-trash"></i></button>
           </td>
       </tr>`

        return html;
    },

    removeAddAnd() {
        $(document).on('click','.js-remove-add-and',function (e) {
            e.preventDefault();
            console.log(1)
            $(this).parents(".js-row-add-and").remove()
        })
    }

}

$(function () {
    JSMONITOR.init()
})
