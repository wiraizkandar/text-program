<template>
	<div class="border rounded p-4">
		<div class="capitalize">{{ title }} :</div>
		<div
			v-if="content !== ''"
			class="text-gray-500 mt-4"
			v-html="content"
		></div>
		<div v-else class="text-gray-500 mt-4 text-center">No Result</div>
	</div>
</template>
<script>
export default {
	props: {
		title: String,
		content: String,
	},
};
</script>
