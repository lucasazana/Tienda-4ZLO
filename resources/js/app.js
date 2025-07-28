
// Confirmación de eliminación de productos solo admin
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.form-eliminar-producto')) {
        document.querySelectorAll('.btn-eliminar').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                const form = btn.closest('form');
                let nombre = '';
                // Desktop: buscar en la fila de la tabla
                const tr = form.closest('tr');
                if (tr && tr.querySelector('.admin-productos-nombre')) {
                    nombre = tr.querySelector('.admin-productos-nombre').textContent.trim();
                } else {
                    // Mobile: buscar en la tarjeta
                    const card = form.closest('.flex.flex-col.bg-black');
                    if (card) {
                        const nombreDiv = card.querySelector('.text-green-400');
                        if (nombreDiv) {
                            nombre = nombreDiv.textContent.trim();
                        }
                    }
                }
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

//  efecto para tarjetas de producto
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.product-tilt-card').forEach(card => {
        const tooltip = card.querySelector('.tooltip-product-card');
        const img = card.querySelector('img');
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            const rotateX = (-y / (rect.height / 2)) * 10;
            const rotateY = (x / (rect.width / 2)) * 10;
            card.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.04)`;
            // Tooltip
            if (tooltip && e.target === img) {
                tooltip.style.opacity = 1;
                tooltip.style.left = (e.clientX - rect.left) + 'px';
                tooltip.style.top = (e.clientY - rect.top - 40) + 'px';
            } else if (tooltip) {
                tooltip.style.opacity = 0;
            }
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg) scale(1)';
            if (tooltip) tooltip.style.opacity = 0;
        });
        card.addEventListener('mouseenter', () => {
            card.style.transition = 'transform 0.2s cubic-bezier(.25,.8,.25,1)';
        });
    });
});

// Envío AJAX del formulario de producto en dashboard (antes inline en Blade)
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('producto-form');
    const successDiv = document.getElementById('success-message');
    const errorDiv = document.getElementById('error-message');
    if (form && successDiv && errorDiv) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            errorDiv.classList.add('hidden');
            errorDiv.textContent = '';
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (response.status === 422 && data.errors) {
                    let errorList = Object.values(data.errors).flat().join('\n');
                    errorDiv.textContent = errorList;
                    errorDiv.classList.remove('hidden');
                } else if (data.success) {
                    form.reset();
                    successDiv.textContent = data.message;
                    successDiv.classList.remove('hidden');
                    setTimeout(() => {
                        successDiv.classList.add('hidden');
                    }, 4000);
                }
            })
            .catch(() => {
                errorDiv.textContent = 'Ocurrió un error al guardar el producto.';
                errorDiv.classList.remove('hidden');
            });
        });
    }
});

// Carrusel de miniaturas y Lightbox
document.addEventListener('DOMContentLoaded', function() {

    // Carrusel principal
    const thumbs = document.getElementById('carousel-thumbs');
    const btnLeft = document.getElementById('carousel-left');
    const btnRight = document.getElementById('carousel-right');
    const mainImg = document.getElementById('main-img');
    let start = 0;
    let visibleCount = 4;
    let thumbsImgs = [];
    if (thumbs && btnLeft && btnRight && mainImg) {
        thumbsImgs = Array.from(thumbs.querySelectorAll('img'));
        function renderThumbs(animDirection = null) {
            thumbsImgs.forEach(img => {
                img.classList.remove('carousel-thumb', 'slide-left', 'slide-right', 'thumb-zoom');
                img.style.display = 'none';
            });
            for (let i = 0; i < Math.min(visibleCount, thumbsImgs.length); i++) {
                const idx = (start + i) % thumbsImgs.length;
                thumbsImgs[idx].style.display = '';
                thumbsImgs[idx].classList.add('carousel-thumb');
                if (animDirection === 'left') {
                    thumbsImgs[idx].classList.add('slide-left');
                    setTimeout(() => thumbsImgs[idx].classList.remove('slide-left'), 450);
                } else if (animDirection === 'right') {
                    thumbsImgs[idx].classList.add('slide-right');
                    setTimeout(() => thumbsImgs[idx].classList.remove('slide-right'), 450);
                }
            }
            // Imagen del medio
            let middleIdx;
            if (thumbsImgs.length === 1) {
                middleIdx = 0;
            } else if (thumbsImgs.length === 2) {
                middleIdx = (start + 0) % thumbsImgs.length;
            } else if (thumbsImgs.length === 3) {
                middleIdx = (start + 1) % thumbsImgs.length;
            } else {
                middleIdx = (start + Math.floor(visibleCount / 2)) % thumbsImgs.length;
            }
            if (thumbsImgs[middleIdx]) {
                thumbsImgs[middleIdx].classList.add('thumb-zoom');
                mainImg.classList.remove('carousel-fade');
                void mainImg.offsetWidth;
                mainImg.src = thumbsImgs[middleIdx].src;
                mainImg.classList.add('carousel-fade');
            }
        }
        renderThumbs();
        btnLeft.addEventListener('click', function() {
            start = (start - 1 + thumbsImgs.length) % thumbsImgs.length;
            renderThumbs('left');
        });
        btnRight.addEventListener('click', function() {
            start = (start + 1) % thumbsImgs.length;
            renderThumbs('right');
        });
        thumbsImgs.forEach((img, i) => {
            img.addEventListener('click', function() {
                mainImg.classList.remove('carousel-fade');
                void mainImg.offsetWidth;
                mainImg.src = img.src;
                mainImg.classList.add('carousel-fade');
            });
        });
    }

    // Lightbox
    const lightbox = document.getElementById('lightbox-modal');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxThumbs = document.getElementById('lightbox-thumbs');
    const lightboxClose = document.getElementById('lightbox-close');
    const navbar = document.getElementById('main-navbar');
    if (mainImg && thumbs && lightbox && lightboxImg && lightboxThumbs && lightboxClose) {
        let currentIdx = 0;
        function openLightbox(idx) {
            lightboxImg.src = thumbsImgs[idx].src;
            currentIdx = idx;

            // Limpiar y renderizar imagenes
            lightboxThumbs.innerHTML = '';
            thumbsImgs.forEach((img, i) => {
                const thumb = document.createElement('img');
                thumb.src = img.src;
                thumb.alt = img.alt;
                thumb.className = 'w-16 h-16 object-cover rounded-lg cursor-pointer border-2 transition-all duration-200 ' + (i === idx ? 'border-softgreen-400 scale-110 shadow-xl' : 'border-transparent opacity-70');
                thumb.addEventListener('click', () => {
                    lightboxImg.src = img.src;
                    currentIdx = i;
                    openLightbox(i);
                });
                lightboxThumbs.appendChild(thumb);
            });
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            if (navbar) navbar.style.display = 'none';
        }
        mainImg.addEventListener('click', function() {

            // Buscar el indice de la imagen principal actual
            const idx = thumbsImgs.findIndex(img => img.src === mainImg.src);
            openLightbox(idx >= 0 ? idx : 0);
        });
        lightboxClose.addEventListener('click', function() {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            if (navbar) navbar.style.display = '';
        });
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                lightbox.classList.add('hidden');
                lightbox.classList.remove('flex');
                if (navbar) navbar.style.display = '';
            }
        });
    }
});


