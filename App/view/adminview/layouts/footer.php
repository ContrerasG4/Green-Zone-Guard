<footer>
    <ul class="footer__ul">
        <li class="footer__icons">
            <a href="https://www.facebook.com" target="_blank">
                <i class="fa-brands fa-square-facebook"></i>
            </a>
        </li>
        <li class="footer__icons">
            <a href="https://www.instagram.com" target="_blank">
                <i class="fa-brands fa-instagram"></i>
            </a>
        </li>
        <li class="footer__icons">
            <a href="https://www.tiktok.com" target="_blank">
                <i class="fa-brands fa-tiktok"></i>
            </a>
        </li>
    </ul>
    <p class="parrafo">&copy; <?php echo date('Y'); ?> Green Zone Guard. Todos los derechos reservados.</p>
    <div class="hora">
        <p><span id="hora"></span></p>
        <p><span id="fecha"></span></p>
    </div> 
    <script>
        function actualizarHora() {
            const ahora = new Date();
            const horas = ahora.getHours().toString().padStart(2, '0');
            const minutos = ahora.getMinutes().toString().padStart(2, '0');
            const segundos = ahora.getSeconds().toString().padStart(2, '0');
            const horaActual = `${horas}:${minutos}:${segundos}`;
            document.getElementById('hora').textContent = horaActual;
        }
        setInterval(actualizarHora, 1000);

        window.onload = actualizarHora;

        const fechaActual = new Date();
        const dia = fechaActual.getDate();
        const mes = fechaActual.getMonth() + 1;
        const año = fechaActual.getFullYear();
        const fechaFormateada = `${dia}/${mes}/${año}`;
        document.getElementById("fecha").textContent = fechaFormateada;
    </script>
</footer>
