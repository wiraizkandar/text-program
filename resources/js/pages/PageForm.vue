<template>
	<div class="w-full md:max-w-4xl mx-auto mt-12">
		<div class="flex flex-row space-x-4">
			<div class="w-full">
				<Alert v-if="isError" :message="errorMessage" />
				<form @submit.prevent="submit">
					<div>
						<textarea
							v-model="inputText"
							placeholder="Input your text here"
							id="message"
							name="message"
							rows="10"
							class="mt-1 p-2 px-4 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
						></textarea>
					</div>
					<div class="mt-6">
						<button
							type="submit"
							class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
						>
							Transform Text
						</button>
					</div>
				</form>
			</div>
			<div class="w-full space-y-4">
				<CardPreview title="upper-case" :content="upperCaseOutput" />
				<CardPreview title="alternate-case" :content="alternateCaseOutput" />
				<CardPreview title="Export Path" :content="exportPath" />
			</div>
		</div>
	</div>
</template>
<script>
import CardPreview from "../components/CardPreview.vue";
import Alert from "../components/Alert.vue";

export default {
	components: {
		CardPreview,
		Alert,
	},
	data() {
		return {
			upperCaseOutput: "",
			alternateCaseOutput: "",
			exportPath: "",
			isError: false,
			errorMessage: "",
			inputText: "",
		};
	},
	methods: {
		showError(errorMessage) {
			this.errorMessage = errorMessage;
			this.isError = true;
		},
		resetForm() {
			this.upperCaseOutput = "";
			this.alternateCaseOutput = "";
			this.exportPath = "";
			this.isError = false;
			this.errorMessage = "";
		},
		submit() {
			this.resetForm();
			// Check if input text is empty
			if (this.inputText === "") {
				this.showError("Please input text to proceed");
				return;
			}
			// Fetch data from the server
			fetch("/api/transform", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
				},
				body: JSON.stringify({
					text: this.inputText,
				}),
			})
				.then((response) => {
					// Check if response is okay
					if (!response.ok) {
						throw new Error("Network response was not ok");
					}
					response.json().then((data) => {
						this.upperCaseOutput = data.data.transformed_text.uppercase;
						this.alternateCaseOutput = data.data.transformed_text.alternatecase;
						this.exportPath = data.data.export_path;
					});
				})
				.catch((error) => {
					this.showError("There was a problem with the fetch operation");
				});
		},
	},
};
</script>
