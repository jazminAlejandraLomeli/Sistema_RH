<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="false" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                    Foto del personal
                </h1>
                <button type="button" class="btn-close close-modal-edit" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="containerPhoto d-flex justify-content-center align-items-end gap-3">
                    <img src="{{ asset('/images/empty-image.jpg') }}" alt="Foto seleccionada" id="preview"
                        style="height: 120px;" />
                    <button class="btn btn-danger rounded-full d-none" id="deletePhoto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" />
                        </svg>
                    </button>

                </div>
                <hr />
                <div class="text-center" id="contentModal">
                    <h5>DOMINGUEZ PADILLA JUAN PEDRO</h5>
                    <p>2969656</p>
                </div>
                <hr />
                <div>
                    <label for="photo" class="form-label">Seleeciona la imagen a subir</label>
                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*" />
                    <span class="text-danger fw-normal" style="display: none;"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal-edit">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-primary" id="uploadPhoto">Subir imagen</button>
            </div>
        </div>
    </div>

</div>