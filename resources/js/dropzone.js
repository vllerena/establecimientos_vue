document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#dropzone')){
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone('div#dropzone', {
            url: '/imagenes/store',
            dictDefaultMessage: 'Sube hasta 10 imágenes máximo',
            maxFiles: 10,
            required: true,
            acceptedFiles: ".png, .jpg, .jpeg",
            addRemoveLinks: true,
            dictRemoveFile: "Eliminar Imagen",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            success: function (file, response) {
                console.log(response);
                file.nombreServidor = response.archivo;
            },
            sending: function (file, xhr, formData) {
                formData.append('uuid', document.querySelector('#uuid').value);
            },
            removedfile: function (file, response) {
                const params = {
                    imagen: file.nombreServidor,
                }

                axios.post('/imagenes/destroy', params)
                    .then(response => {
                        console.log(response);
                        file.previewElement.parentNode.removeChild(file.previewElement);
                    })
            }
        });
    }

})
