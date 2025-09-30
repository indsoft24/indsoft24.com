<script src="https://cdn.tiny.cloud/1/lh8jehix8bjhc4pveqx22drhh6jounjjgqg3b2ba72xotr3e/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    tinymce.init({
      selector: 'textarea.tinymce-editor', 
      plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
      toolbar: 'undo redo | blocks | ' +
               'bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter ' +
               'alignright alignjustify | bullist numlist outdent indent | ' +
               'link image media table | removeformat | fullscreen preview code | help',
      height: 500,

      // Image Upload configuration
      image_title: true,
      automatic_uploads: true,
      file_picker_types: 'image',

      // This points to the upload route we created earlier
      images_upload_url: '{{ route("admin.posts.uploadImage") }}',

      // This handles the actual file upload process
      images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
          const xhr = new XMLHttpRequest();
          xhr.withCredentials = false;
          xhr.open('POST', '{{ route("admin.posts.uploadImage") }}');

          xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

          xhr.upload.onprogress = (e) => {
              progress(e.loaded / e.total * 100);
          };

          xhr.onload = () => {
              if (xhr.status < 200 || xhr.status >= 300) {
                  reject('HTTP Error: ' + xhr.status);
                  return;
              }

              const json = JSON.parse(xhr.responseText);

              if (!json || typeof json.location != 'string') {
                  reject('Invalid JSON: ' + xhr.responseText);
                  return;
              }

              resolve(json.location);
          };

          xhr.onerror = () => {
              reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
          };

          const formData = new FormData();
          formData.append('file', blobInfo.blob(), blobInfo.filename());

          xhr.send(formData);
      }),
    });
  });
</script>