<template>
    <Transition name="modal-fade">
        <div v-if="modelValue" class="modal-overlay" @click.self="cerrar">
            <div class="modal-box">
                <button class="modal-close-btn" @click="cerrar" type="button">
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <img
                    :src="'/images/logo-magnesol.svg'"
                    class="modal-logo"
                    alt="MaquiNet"
                />
                <h2 class="modal-titulo">
                    Déjanos tus datos para<br />comenzar a jugar
                </h2>
                <form
                    @submit.prevent="enviarFormulario"
                    class="modal-formulario"
                >
                    <div class="modal-campo">
                        <label>Nombre *</label>
                        <input
                            v-model="form.nombre"
                            type="text"
                            placeholder="Nombre"
                            :class="{ 'input-error': errores.nombre }"
                            @input="limpiarError('nombre')"
                        />
                        <span v-if="errores.nombre" class="texto-error">{{
                            errores.nombre
                        }}</span>
                    </div>

                    <!-- Apellido -->
                    <div class="modal-campo">
                        <label>Apellido *</label>
                        <input
                            v-model="form.apellido"
                            type="text"
                            placeholder="Apellido"
                            :class="{ 'input-error': errores.apellido }"
                            @input="limpiarError('apellido')"
                        />
                        <span v-if="errores.apellido" class="texto-error">{{
                            errores.apellido
                        }}</span>
                    </div>

                    <div class="modal-campo">
                        <label>DNI / Carnet de extranjería </label>
                        <input
                            v-model="form.dni"
                            type="text"
                            placeholder="0988158549"
                            :class="{ 'input-error': errores.dni }"
                            @input="limpiarError('dni')"
                        />
                        <span v-if="errores.dni" class="texto-error">{{
                            errores.dni
                        }}</span>
                    </div>

                    <div class="modal-campo">
                        <label>Correo Electrónico *</label>
                        <input
                            v-model="form.email"
                            type="email"
                            placeholder="Correo Electrónico"
                            :class="{ 'input-error': errores.email }"
                            @input="limpiarError('email')"
                        />
                        <span v-if="errores.email" class="texto-error">{{
                            errores.email
                        }}</span>
                    </div>

                    <div class="modal-campo">
                        <label>Teléfono *</label>
                        <input
                            v-model="form.telefono"
                            type="tel"
                            placeholder="Teléfono"
                            :class="{ 'input-error': errores.telefono }"
                            @input="limpiarError('telefono')"
                        />
                        <span v-if="errores.telefono" class="texto-error">{{
                            errores.telefono
                        }}</span>
                    </div>

                    <div class="modal-checkbox-grupo">
                        <input
                            v-model="form.aceptaTerminos"
                            type="checkbox"
                            id="terminos-modal"
                            :class="{ 'input-error': errores.aceptaTerminos }"
                            @change="limpiarError('aceptaTerminos')"
                        />
                        <label for="terminos-modal">
                            He leído y acepto los
                            <a href="#" @click.prevent
                                >Términos y condiciones</a
                            >
                            y
                            <a href="#" @click.prevent
                                >Política de Privacidad</a
                            >
                            de este concurso
                        </label>
                    </div>
                    <span
                        v-if="errores.aceptaTerminos"
                        class="texto-error texto-error-check"
                    >
                        {{ errores.aceptaTerminos }}
                    </span>

                    <button
                        type="submit"
                        class="modal-boton-enviar"
                        :disabled="cargando"
                    >
                        {{ cargando ? "Enviando..." : "¡Jugar ahora!" }}
                    </button>
                </form>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { ref, reactive, watch } from "vue";
import axios from "axios";

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["update:modelValue", "registroExitoso"]);

const cargando = ref(false);

const form = reactive({
    nombre: "",
    apellido: "",
    dni: "",
    email: "",
    telefono: "",
    aceptaTerminos: false,
});

const errores = reactive({
    nombre: "",
    apellido: "",
    dni: "",
    email: "",
    telefono: "",
    aceptaTerminos: "",
});

const cerrar = () => {
    emit("update:modelValue", false);
    resetearFormulario();
};

const limpiarError = (campo) => {
    errores[campo] = "";
};

const validarFormulario = () => {
    let valido = true;
    Object.keys(errores).forEach((key) => (errores[key] = ""));
    if (!form.nombre.trim()) {
        errores.nombre = "El nombre es obligatorio";
        valido = false;
    } else if (form.nombre.length < 2) {
        errores.nombre = "El nombre debe tener al menos 2 caracteres";
        valido = false;
    }
    if (!form.apellido.trim()) {
        errores.apellido = "El apellido es obligatorio";
        valido = false;
    } else if (form.apellido.length < 2) {
        errores.apellido = "El apellido debe tener al menos 2 caracteres";
        valido = false;
    }

    // if (form.dni != null && form.dni.length < 6) {
    //     errores.dni = "El DNI/Carnet debe tener al menos 6 caracteres";
    //     valido = false;
    // }

    if (!form.email.trim()) {
        errores.email = "El correo electrónico es obligatorio";
        valido = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) {
        errores.email = "El correo electrónico no es válido";
        valido = false;
    }

    if (!form.telefono.trim()) {
        errores.telefono = "El teléfono es obligatorio";
        valido = false;
    } else if (!/^\d{7,15}$/.test(form.telefono.replace(/\s/g, ""))) {
        errores.telefono = "El teléfono debe contener entre 7 y 15 dígitos";
        valido = false;
    }
    if (!form.aceptaTerminos) {
        errores.aceptaTerminos = "Debes aceptar los términos y condiciones";
        valido = false;
    }

    return valido;
};

const enviarFormulario = async () => {
    if (!validarFormulario()) {
        return;
    }

    cargando.value = true;

    try {
        const response = await axios.post("/api/register-player", form);

        const datosUsuario = {
            nombre: form.nombre,
            apellido: form.apellido,
            email: form.email,
        };

        localStorage.setItem(
            "usuario_registrado",
            JSON.stringify(datosUsuario)
        );
        emit("registroExitoso", response.data);
        cerrar();
        setTimeout(() => {
            window.location.href = "/thankyou";
        }, 500);
    } catch (error) {
        if (error.response && error.response.status === 422) {
            const erroresBackend = error.response.data.errors;

            Object.keys(erroresBackend).forEach((key) => {
                if (errores.hasOwnProperty(key)) {
                    errores[key] = erroresBackend[key][0];
                }
            });
        } else {
            alert("Ocurrió un error. Por favor intenta nuevamente.");
            console.error("Error:", error);
        }
    } finally {
        cargando.value = false;
    }
};

const resetearFormulario = () => {
    Object.keys(form).forEach((key) => {
        if (typeof form[key] === "boolean") {
            form[key] = false;
        } else {
            form[key] = "";
        }
    });
    Object.keys(errores).forEach((key) => (errores[key] = ""));
};

watch(
    () => props.modelValue,
    (nuevoValor) => {
        if (nuevoValor) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = "auto";
        }
    }
);
</script>
