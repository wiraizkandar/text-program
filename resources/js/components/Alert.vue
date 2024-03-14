<template>
	<div
		v-if="message !== ''"
		v-html="message"
		role="alert"
		class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:text-red-400"
	></div>
	<div v-else class="text-gray-500 mt-4 text-center">
		Oops! something went wrong
	</div>
</template>
<script>
export default {
	props: {
		message: String,
	},
};
</script>
