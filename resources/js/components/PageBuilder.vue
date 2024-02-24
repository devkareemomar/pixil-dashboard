<script setup>
import {
	defineAsyncComponent,
	defineEmits,
	provide,
	reactive,
	ref,
	toRefs,
	watch
} from "vue"
import NewsLeft from "./items/newsleft/NewsLeft.vue"
import NewsRight from "./items/newsright/NewsRight.vue"
import Projects from "./items/projects/Projects.vue"
import HomeContact from "./items/homecontact/HomeContact.vue"
import Editor from "./../editor/Editor.vue"

const emits = defineEmits(["changeStyle"])

const editing = ref(true)
const layouts = ref([
	"Header",
	"Spotzone",
	"Slider",
	"Projects",
	"HomeContact",
	"Statistics",
	"Post",
	"NewsCarousel",
	"NewsLeft",
	"NewsRight",
	"Footer"
])

const props = defineProps(["page"])
const { page } = toRefs(props)
provide("page", page)

const items = reactive(page.value.builder_content || [])

let selectedStyle = ref(null)

function handleChangeStyle(e) {
	selectedStyle.value = e
}

function getComponent(layout) {
	if (layout) {
		let component = layout
		return defineAsyncComponent(() =>
			import(`./items/${layout.toLowerCase()}/${component}.vue`)
		)
	}
}
</script>
<template>
	<div class="row">
		<div class="container-fluid">
			<main style="width: 80%; margin-left: 300px">
				<div id="page">
					<div class="col-md-12" style="margin: 0 auto">
						<div id="content">
							<template v-for="item in items">
								<component
									:is="getComponent(item.layout)"
									:item="item"
									:style="selectedStyle"
								/>
							</template>
						</div>
					</div>
				</div>
				<Editor
					v-if="editing"
					:items="items"
					:layouts="layouts"
					@changeStyle="handleChangeStyle"
				></Editor>
			</main>
		</div>
	</div>
</template>
