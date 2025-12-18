<template>
    <div class="page">
        <!-- DESKTOP HERO -->
        <section class="hero">
            <img :src="'/images/logo-magnesol.svg'" class="logo" alt="Logo" />

            <div class="content">
                <p class="main-text">
                    Pon a prueba tus conocimientos sobre maquinet.com<br />
                    y gana una MINIATURA CAT® + 01 Kit MaquiNet
                </p>

                <div class="buttons">
                    <button class="btn-outline">¿Cómo jugar?</button>
                    <button class="btn-primary" @click="abrirModal">
                        ¡Empieza ahora!
                    </button>
                </div>
            </div>
        </section>

        <!-- MOBILE HERO -->
        <section class="hero-mobile">
            <!-- Logo arriba -->
            <div class="mobile-header">
                <img
                    :src="'/images/logo-magnesol.svg'"
                    class="mobile-logo"
                    alt="MaquiNet Logo"
                />
            </div>

            <!-- Imagen de fondo con excavadora -->
            <div class="mobile-banner"></div>

            <!-- Contenido negro abajo -->
            <div class="mobile-content">
                <!-- Texto -->
                <p class="mobile-text">
                    Pon a prueba tus conocimientos sobre maquinet.com y gana una
                    MINIATURA CAT® + 01 Kit MaquiNet
                </p>

                <!-- Botón -->
                <button class="btn-primary" @click="abrirModal">
                    ¡Empieza ahora!
                </button>

                <!-- Redes sociales en fila -->
                <div class="mobile-socials">
                    <img :src="'/images/Facebook.svg'" alt="Facebook" />
                    <img :src="'/images/Instagram.svg'" alt="Instagram" />
                    <img :src="'/images/X.svg'" alt="X" />
                    <img :src="'/images/LinkedIn.svg'" alt="LinkedIn" />
                    <img :src="'/images/Youtube.svg'" alt="YouTube" />
                </div>

                <!-- Términos y condiciones -->
                <div class="mobile-terms">
                    © 2025 MaquiNet. Todos los derechos reservados.
                    <a href="#">Términos y condiciones</a>
                </div>

                <!-- Logo Ferreycorp -->
                <div class="mobile-footer-logo">
                    <img :src="'/images/logo-footer.svg'" alt="Ferreycorp" />
                </div>
            </div>
        </section>

        <!-- FOOTER DESKTOP -->
        <footer class="footer">
            <div class="footer-container">
                <div class="footer-socials">
                    <img :src="'/images/Facebook.svg'" alt="Facebook" />
                    <img :src="'/images/Instagram.svg'" alt="Instagram" />
                    <img :src="'/images/X.svg'" alt="X" />
                    <img :src="'/images/LinkedIn.svg'" alt="LinkedIn" />
                    <img :src="'/images/Youtube.svg'" alt="YouTube" />
                </div>

                <div class="footer-text">
                    © 2025 MaquiNet. Todos los derechos reservados.
                    <a href="#" class="footer-link">Términos y condiciones</a>
                </div>

                <div class="footer-logo">
                    <img :src="'/images/logo-footer.svg'" alt="Ferreycorp" />
                </div>
            </div>
        </footer>

        <!-- ============================================
             MODAL DE REGISTRO (NUEVO - NO MODIFICA NADA ANTERIOR)
        ============================================ -->
        <ModalRegistro
            v-model="mostrarModal"
            @registroExitoso="manejarRegistroExitoso"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import ModalRegistro from "./FormModal.vue";

// Estado del modal
const mostrarModal = ref(false);

// Abrir modal
const abrirModal = () => {
    mostrarModal.value = true;
};

// Manejar registro exitoso
const manejarRegistroExitoso = (data) => {
    console.log("Jugador registrado:", data);
    // Aquí puedes redirigir al juego o hacer lo que necesites
    // window.location.href = '/juego'
};
</script>
