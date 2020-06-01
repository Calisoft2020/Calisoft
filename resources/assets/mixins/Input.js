
export default {
	props: {
		name: { type: String, required: true },
		type: { type: String, default: 'text' },
		value: [String, Number],
		hasError: Boolean,
		errorMessages: { 
			type: Array, 
			default() { 
				return [] 
			} 
		}
	},
	methods: {
		input(event) {
			this.$emit('input', event.target.value)
		},
		focus() {
			document.getElementsByName(this.name)[0].focus()
		}
	},
	computed: {
		state() {
			return { 
				'has-error': Boolean(this.hasError || this.errorMessages.length) 
			}
		}
	}
}