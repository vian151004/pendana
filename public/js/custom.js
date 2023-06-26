$('.custom-file-input').on('change', function () {
    let filename = $(this).val().split('\\').pop();
    $(this)
        .next('.custom-file-label')
        .addClass('selected')
        .html(filename);
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function preview(target, image) {
    $(target)
        .attr('src', window.URL.createObjectURL(image))
        .show();
}

function resetForm(selector) {
    $(selector)[0].reset();
    
    $('.select2').trigger('change');
    $('.form-control, .custom-select, [type=radio], [type=checkbox], [type=file], .select2, .note-editor').removeClass('is-invalid');
    $('.invalid-feedback').remove();
}

function loopForm(originalForm) {
    for (field in originalForm) {
        if ($(`[name=${field}]`).attr('type') != 'file') {
            if ($(`[name=${field}]`).hasClass('summernote')) {
                $(`[name=${field}]`).summernote('code', originalForm[field]);
            } else if ($(`[name=${field}]`).attr('type') == 'radio') {
                $(`[name=${field}]`).filter(`[value="${originalForm[field]}"]`).prop(`checked`, true);
            } else {
                $(`[name=${field}]`).val(originalForm[field]);
            }

            $('select').trigger('change');
        } else{
            $(`.preview-${field}`)
                .attr('src', originalForm[field])
                .show();
        }
    }
}

function loopErrors(errors) {
    $('.invalid-feedback').remove();

    if (errors == undefined) {
        return; 
    }

    for (error in errors) {
        $(`[name=${error}]`).addClass('is-invalid');

        if ($(`[name=${error}]`).hasClass('select2')) {
            $(`<span class="error invalid-feedback">${errors[error][0]}</span>`) 
                .insertAfter($(`[name=${error}]`).next());
        } else if ($(`[name=${error}]`).hasClass('summernote')) {
            $('.note-editor').addClass('is-invalid');
            $(`<span class="error invalid-feedback">${errors[error][0]}</span>`) 
                .insertAfter($(`[name=${error}]`).next());
        } else if ($(`[name=${error}]`).hasClass('custom-control-input')) {
            $(`<span class="error invalid-feedback">${errors[error][0]}</span>`) 
                .insertAfter($(`[name=${error}]`).next());
        } else {
            if ($(`[name=${error}]`).length == 0) {
             $(`[name="${error}[]"]`).addClass('is-invalid');
             $(`<span class="error invalid-feedback">${errors[error][0]}</span>`) 
                .insertAfter($(`[name="${error}[]"]`).next());
            } else {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`) 
                    .insertAfter($(`[name=${error}]`));
            }
        }
    }
} 

function showAlert(message, type) {
    let title = '';

    switch (type) {
        case 'success':
            title = 'Success'
            break;
        case 'danger':
            title = 'Failed'
            break;
       default:
            break;
    }

    $(document).Toasts('create', {
        class: `bg-${type}`,
        title: title,
        body: message 
    });

    setTimeout(() => {
        $('.toasts-top-right').remove();
    }, 3000);
}