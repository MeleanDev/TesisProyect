<div class="modal fade" id="modalVerificarCertificado" tabindex="-1" aria-labelledby="modalVerificarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerificarLabel">
                    <i class="fas fa-check-circle me-2"></i>Verificar Autenticidad del Certificado
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Ingresa el código único que aparece en el certificado para validar su autenticidad y visualizar el documento.</p>
                <form id="formVerificarCertificado">
                    <div class="mb-3">
                        <label for="codigo_certificado_input" class="form-label">Código del Certificado</label>
                        <input type="text" class="form-control" id="codigo_certificado_input" name="codigo" placeholder="Ej: CADI-123XYZ" required>
                    </div>
                    <div id="verificar-error-message" class="text-danger mt-2"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary custom-btn" form="formVerificarCertificado" id="btnVerificarCertificado">
                    <span id="btn-text">Verificar</span>
                    <span id="btn-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                </button>
            </div>
        </div>
    </div>
</div>