<template>
    <div class="thankyou-page">
        <section class="thankyou-hero">
            <img
                :src="'/images/logo-magnesol.svg'"
                class="thankyou-logo"
                alt="MaquiNet Logo"
            />
            <div class="thankyou-container">
                <div class="thankyou-icon">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                        <circle
                            cx="40"
                            cy="40"
                            r="38"
                            stroke="#f5c400"
                            stroke-width="4"
                        />
                        <path
                            d="M25 40L35 50L55 30"
                            stroke="#f5c400"
                            stroke-width="4"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </div>
                <h1 class="thankyou-titulo">¡Gracias por registrarte!</h1>
                <p class="thankyou-subtitulo">Tu registro ha sido exitoso</p>
                <div class="thankyou-mensaje">
                    <p>
                        <strong>{{ nombreCompleto }},</strong> tu participación
                        en el reto
                        <span class="texto-destacado">MaquiNet</span> ha sido
                        confirmada.
                    </p>
                    <p>
                        Hemos enviado un correo de confirmación a:<br />
                        <strong>{{ emailUsuario }}</strong>
                    </p>
                </div>
                <div class="thankyou-info">
                    <div class="info-item">
                        <div class="info-icon">🎯</div>
                        <div class="info-texto">
                            <h3>Próximos pasos</h3>
                            <p>
                                Prepárate para poner a prueba tus conocimientos
                                sobre maquinaria pesada
                            </p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">🎁</div>
                        <div class="info-texto">
                            <h3>Premio</h3>
                            <p>
                                Miniatura CAT® + Kit MaquiNet para los ganadores
                            </p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">📧</div>
                        <div class="info-texto">
                            <h3>Mantente atento</h3>
                            <p>
                                Te contactaremos con más información sobre el
                                concurso
                            </p>
                        </div>
                    </div>
                </div>
                <div class="thankyou-acciones">
                    <button @click="irAlJuego" class="btn-jugar">
                        Comenzar el reto
                    </button>
                    <button @click="volverAlInicio" class="btn-secundario">
                        Volver al inicio
                    </button>
                </div>
                <div class="thankyou-redes">
                    <p>Síguenos en nuestras redes sociales</p>
                    <div class="redes-iconos">
                        <a href="#" class="red-social">
                            <img :src="'/images/Facebook.svg'" alt="Facebook" />
                        </a>
                        <a href="#" class="red-social">
                            <img
                                :src="'/images/Instagram.svg'"
                                alt="Instagram"
                            />
                        </a>
                        <a href="#" class="red-social">
                            <img :src="'/images/X.svg'" alt="X" />
                        </a>
                        <a href="#" class="red-social">
                            <img :src="'/images/LinkedIn.svg'" alt="LinkedIn" />
                        </a>
                        <a href="#" class="red-social">
                            <img :src="'/images/Youtube.svg'" alt="YouTube" />
                        </a>
                    </div>
                </div>
            </div>
            <footer class="thankyou-footer">
                <div class="footer-content">
                    <p>© 2025 MaquiNet. Todos los derechos reservados.</p>
                    <div class="footer-links">
                        <a href="#">Términos y condiciones</a>
                        <span>|</span>
                        <a href="#">Política de privacidad</a>
                    </div>
                    <img
                        :src="'/images/logo-footer.svg'"
                        alt="Ferreycorp"
                        class="footer-logo-img"
                    />
                </div>
            </footer>
        </section>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const nombreCompleto = ref("Usuario");
const emailUsuario = ref("usuario@ejemplo.com");

onMounted(() => {
    const datosGuardados = localStorage.getItem("usuario_registrado");

    if (datosGuardados) {
        try {
            const usuario = JSON.parse(datosGuardados);
            nombreCompleto.value = `${usuario.nombre} ${usuario.apellido}`;
            emailUsuario.value = usuario.email;
            localStorage.removeItem("usuario_registrado");
        } catch (error) {
            console.error("Error al leer datos del usuario:", error);
        }
    }
});

const irAlJuego = () => {
    window.location.href = "/juego";
};

const volverAlInicio = () => {
    window.location.href = "/";
};
</script>
