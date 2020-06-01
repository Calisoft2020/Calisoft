<template>
	<form @submit.prevent="safeExec(store)" novalidate>
      	<text-input name="name"  label="Nombre" icon="fa fa-user" pattern="[a-zA-ZáéíóúñÁÉÍÓÚ ]{2,60}"
      		v-model="user.name" v-validate="'required|alpha_spaces|max:30'" data-vv-as="nombre"
      		:error-messages="errors.collect('name')" required/>

      	<text-input type="email" name="email" label="Correo" icon="fa fa-envelope-o"
      		v-model="user.email" v-validate="'required|email|max:255'" data-vv-as="correo"
      		:error-messages="errors.collect('email')" required/>
                  
        <text-input type="password" name="password" label="Contraseña" icon="fa fa-key" pattern="[^=<> -]{5,30}"
        	v-model="user.password" v-validate="'required|min:6'" data-vv-as="contraseña"
			:error-messages="errors.collect('password')" required/>
                  
        <text-input type="password" name="password_confirmation" label="Confirmar Contraseña" icon="fa fa-key" pattern="[^=<> -]{5,30}"
        	v-model="user.password_confirmation" v-validate="{ required: true, confirmed: user.password }"
        	data-vv-as="confirmar contraseña" :error-messages="errors.collect('password')" required/>

        <select-input v-model="user.role" name="role" icon="fa fa-users" label="Role" 
			v-validate="'required'" :error-messages="errors.collect('role')" selected="evaluator" 
			required>
            <option value="admin">Administrador</option>
            <option value="evaluator">Evaluador</option>
        </select-input>

        
		<button type="submit" class="btn green-jungle center-block">
		    <i class="fa fa-plus"></i>Registrar
		</button>
       
    </form>
</template>

<script>
import TextInput from "../inputs/text-input";
import SelectInput from "../inputs/select-input";
export default {
	components: { TextInput, SelectInput },
	data() { 
		return { user: {} }
	},
	methods: {
		store() {
            axios.post('/api/usuarios', this.user)
                .then(response => {
                    this.$emit('created', response.data);
                    this.user = {};
					setTimeout(() => this.errors.clear())
                })
                .catch(reason => this.setErrors(reason.response.data.errors));
        },
	}
}
</script>