<script setup>
import { toRefs, watch, ref } from "vue"
const props = defineProps(["item", "style"])
const { item, style } = toRefs(props)
const siteUrl = ref(import.meta.env.VITE_BACKEND_BASE_URL)

const selectedStyle = ref("style1")

watch(style, (newValue, oldValue) => {
	if (style.value.item.layout?.toLowerCase() === "projects") {
		selectedStyle.value = style.value.item.selectedStyles
	}
})
</script>
<template>
	<section :id="item.id" class="editable text-center" data-fields="">
		<div class="container-fluid">
			<div class="col-md-12">
				<img
					:src="`${siteUrl}/components/items/projects/${selectedStyle}.png`"
					alt=""
					@changeStyle="handleStyleChange"
				/>
			</div>
		</div>
	</section>
</template>
