var uploaderObj;
function initUploader(){
uploaderObj = $(dropContainer).dmUploader({ //
      url: upload_file_url,
      maxFileSize: maxFileSize,
      multiple: false,
      allowedTypes: allowedTypes,
      extFilter: extFilter,
      onDragEnter: function(){
          // Happens when dragging something over the DnD area
          this.addClass('active');
      },
      onDragLeave: function(){
          // Happens when dragging something OUT of the DnD area
          this.removeClass('active');
      },
      onInit: function(){
          // Plugin is ready to use
          ui_add_log('Penguin initialized :)', 'info');
          $(responseContainer).val('');
      },
      onComplete: function(){
          // All files in the queue are processed (success or error)
          ui_add_log('All pending tranfers finished');
      },
      onNewFile: function(id, file){
          // When a new file is added using the file selector or the DnD area
          ui_add_log('New file added #' + id);

          if (typeof FileReader !== "undefined"){
              var reader = new FileReader();
              var img = this.find('img');

              reader.onload = function (e) {
                  img.attr('src', e.target.result);
              }
              reader.readAsDataURL(file);
          }
      },
      onBeforeUpload: function(id){
          // about tho start uploading a file
          ui_add_log('Starting the upload of #' + id);
          ui_single_update_progress(this, 0, true);
          ui_single_update_active(this, true);

          ui_single_update_status(this, 'Uploading...');
      },
      onUploadProgress: function(id, percent){
          // Updating file progress
          ui_single_update_progress(this, percent);
      },
      onUploadSuccess: function(id, data){
          var response = data;

          // A file was successfully uploaded
          ui_add_log('Server Response for file #' + id + ': ' + response);
          ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');

          ui_single_update_active(this, false);

          // You should probably do something with the response data, we just show it
          $(responseContainer).val(response);
          $('#add_to_cart_form').show();
          $('#upload_custom_design').hide();
          $('#uploaded_image_container').html('<img style="width: 250px;" src="'+response+'" class="img-thumbnail"><a href="javascript:void(0)" onclick="changeUploadedImage()" style="position: absolute;top: -18px;"><i class="fa fa-close"></i></a>');

          ui_single_update_status(this, 'Upload completed.', 'success');
      },
      onUploadError: function(id, xhr, status, message){
          // Happens when an upload error happens
          ui_single_update_active(this, false);
          ui_single_update_status(this, 'Error: ' + message, 'danger');
      },
      onFallbackMode: function(){
          // When the browser doesn't support this plugin :(
          ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
      },
      onFileSizeError: function(file){
          ui_single_update_status(this, 'File excess the size limit', 'danger');

          ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
      },
      onFileTypeError: function(file){
          ui_single_update_status(this, 'File type is not an image', 'danger');

          ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
      },
      onFileExtError: function(file){
          ui_single_update_status(this, 'File extension not allowed', 'danger');

          ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
      }
  });
}

        function ui_single_update_active(element, active) {
            element.find('div.progress').toggleClass('d-none', !active);
            //$(responseContainer).toggleClass('d-none', active);

            element.find('input[type="file"]').prop('disabled', active);
            element.find('.btn').toggleClass('disabled', active);

            element.find('.btn i').toggleClass('fa-circle-o-notch fa-spin', active);
            element.find('.btn i').toggleClass('fa-folder-o', !active);
        }

        function ui_single_update_progress(element, percent, active) {
            active = (typeof active === 'undefined' ? true : active);

            var bar = element.find('div.progress-bar');

            bar.width(percent + '%').attr('aria-valuenow', percent);
            bar.toggleClass('progress-bar-striped progress-bar-animated', active);

            if (percent === 0){
                bar.html('');
            } else {
                bar.html(percent + '%');
            }
        }

        function ui_single_update_status(element, message, color) {
            color = (typeof color === 'undefined' ? 'muted' : color);

            element.find('small.status').prop('class','status text-' + color).html(message);
        }