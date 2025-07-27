// Confirmación de eliminación de productos (solo admin)
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.form-eliminar-producto')) {
        document.querySelectorAll('.btn-eliminar').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                const form = btn.closest('form');
                const nombre = form.closest('tr').querySelector('.admin-productos-nombre').textContent.trim();
                mostrarModalEliminar(form, nombre);
            });
        });
    }
});

function mostrarModalEliminar(form, nombre) {
    let modal = document.getElementById('modal-eliminar');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'modal-eliminar';
        modal.innerHTML = `
            <div class="modal-eliminar-overlay">
                <div class="modal-eliminar-box">
                    <div class="modal-eliminar-titulo">¿Seguro que quieres eliminar el producto<br>"<span id='nombre-prod' class='modal-eliminar-nombre'></span>"?</div>
                    <div class="modal-eliminar-botones">
                        <button id="btn-cancelar-eliminar" class="modal-eliminar-cancelar">Cancelar</button>
                        <button id="btn-confirmar-eliminar" class="modal-eliminar-confirmar">Eliminar</button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }
    modal.style.display = 'flex';
    modal.querySelector('#nombre-prod').textContent = nombre;
    modal.querySelector('#btn-cancelar-eliminar').onclick = function() {
        modal.style.display = 'none';
    };
    modal.querySelector('#btn-confirmar-eliminar').onclick = function() {
        modal.style.display = 'none';
        form.submit();
    };
}

//-----------------------------------------------------------//

