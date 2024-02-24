<script setup>
import { toRefs, watch, ref } from "vue"
const props = defineProps(["item", "style"])
const { item, style } = toRefs(props)
const siteUrl = ref(import.meta.env.VITE_BACKEND_BASE_URL)
const selectedStyle = ref("style1")

watch(style, (newValue, oldValue) => {
	console.log("welcome")
	if (style.value.item.layout === "Slider") {
		selectedStyle.value = style.value.item.selectedStyle
	}
})
</script>
<template>
	<section :id="item.id" class="editable text-center" data-fields="">
		<div class="container-fluid">
			<div class="col-md-12">
				<img :src="`${siteUrl}/components/items/slider/${selectedStyle}.png`" />
			</div>
		</div>
	</section>
</template>
