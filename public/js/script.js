(function($){

    function convertForm2Json(form){
        const array = $(form).serializeArray();
        const json = {};
        $.each(array,function(){
            json[this.name] = this.value;
        });
        return JSON.stringify(json);

    }

    $('form.delete').on('submit',(e)=>{
        e.preventDefault();
        const form = $(e.target);
        // console.log(form.data('title'),form.data('body'));
        $('#deleteModalLabel').text(form.data('title')); //test()  innerText
        $('#deleteModal .modal-body').html(form.data('body')); //html()  innerHTML
   
        const errorEl = $('#wrapper .alert.alert-danger');
        let errorMsg = form.data('error');

        $('#deleteModal .btn-danger').off().on('click',(e)=>{
            $.ajax({
                url: form.attr('action'),
                method: 'delete',
                contentType: 'application/json',
                data: convertForm2Json(form),
                success : function(response){
                    if( response.status == 200){
                        let successAlertEl = $('<div class="alert alert-success"></div>').html(response.msg);
                        console.log(form.closest('table'));
                        form.closest('table').before(successAlertEl);
                        form.closest('tr').remove();
                    }
                },
                error: function(xhr){
                    console.log(xhr.status,xhr.statusText);
                    
                    if( errorMsg ){
                        if( errorEl.length == 1 ){
                            console.log('error');
                            errorEl.html(errorMsg);
                        }
                        else{
                            errorMsg = xhr.responseJSON.msg;
                            let errorAlertEl = $('<div class="alert alert-danger"></div>').html(errorMsg);
                            form.closest('table').before(errorAlertEl);
                        }
                    }

                }
            })
        })
    });
    
})(jQuery)

/**
 * Add popover to elements with [data-bs-toggle="popover"]
 */
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

/**
 * Toggle 'display:show' for elements with selected class on click.
 */
document.querySelector('.diet-settings').addEventListener('click', function(){
    document.querySelector('.wrapper-settings').classList.toggle('show-block');
});