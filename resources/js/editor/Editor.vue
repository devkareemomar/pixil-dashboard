<script setup>
import Editor from "@tinymce/tinymce-vue"
import { defineEmits, onMounted, ref, toRefs } from "vue"
import AddContent from "./components/AddContent.vue"
import ImageResize from "./components/ImageResize.vue"

const siteUrl = ref(import.meta.env.VITE_BACKEND_BASE_URL)

const emits = defineEmits(["changeStyle"])

const props = defineProps({
	items: {
		type: Array,
		default: []
	},
	layouts: {
		type: Array,
		default: []
	}
})
const { items, layouts } = toRefs(props)

const item = ref(false)
const fields = ref(false)
const showContentSideBar = ref(false)

function handleStyleChange(e) {
	emits("changeStyle", {
		item: item,
		selectedStyle: e.target.value
	})
}

function save() {}

function setImage(e) {
	item.value[e.key] = e.value
}

function deleteItem(id) {
	let r = confirm("Are you sure you want to delete this item?")
	if (r == true) {
		items.value.splice(
			items.value.findIndex(x => x.id === id),
			1
		)
		item.value = false
	}
}

function moveItem(id) {
	let from = items.value.findIndex(x => x.id == id)
	let to = from + 1
	let f = items.value.splice(from, 1)[0]
	items.value.splice(to, 0, f)
}

function moveItemUp(id) {
	let from = items.value.findIndex(x => x.id == id)
	if (from != 0) {
		let to = from - 1
		let f = items.value.splice(from, 1)[0]
		items.value.splice(to, 0, f)
	}
}

onMounted(function () {
	document.body.addEventListener("click", function (e) {
		if (e.target.closest(".editable")) {
			let el = e.target.closest(".editable")
			let id = el.id
			item.value = items.value.filter(x => x.id === id)[0]

			let myfields = el.getAttribute("data-fields")
			let params = new URLSearchParams(myfields)
			myfields = Object.fromEntries(params.entries())
			fields.value = myfields

			showContentSideBar.value = true
		}
	})
})
</script>
<template>
	<transition name="slide-right">
		<div
			class="editor slidein-right"
			v-if="item && showContentSideBar"
			spellcheck="false"
		>
			<div class="editor-header">
				<h4 class="float-left">Edit</h4>
				<div class="close" @click="showContentSideBar = false">&times;</div>
			</div>
			<div class="editor-content">
				<div v-for="(val, key) in fields">
					<div class="label">{{ key.replace("_", " ") }}</div>

					<input
						type="text"
						class="form-control"
						v-if="val == 'txt'"
						v-model="item[key]"
					/>

					<Editor
						v-if="val === 'rte'"
						v-model="item[key]"
						api-key="fsfdsf"
						:init="{
							content_css: [
								siteUrl + '/assets/page-builder/css/layout.css',
								'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css'
							],
							plugins:
								'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
							toolbar:
								'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
							tinycomments_mode: 'embedded',

							apiKey: 'bahs2n8vhp90i80idsr5qoz8itxldfn0qhzp683kco20syyy',
							valid_elements: '*[*]'
						}"
						style="height: 600px"
					/>

					<image-resize
						v-if="val == 'img'"
						v-bind:mKey="key"
						@image="setImage"
					></image-resize>
					<input
						v-if="val == 'vid'"
						type="text"
						class="form-control"
						v-model="item[key]"
					/>
				</div>
				<div v-if="item.styles">
					<div class="label">Selected Style</div>
					<select
						v-model="item['selectedStyles']"
						class="form-control"
						@change="handleStyleChange"
					>
						<option
							v-for="style in item.styles"
							:value="style.name"
							:key="style.name"
						>
							{{ style.name }}
						</option>
					</select>
				</div>

				<span v-if="item.layout != 'header'">
					<div class="label">Options</div>
					<div class="btn-group w-100">
						<button
							class="btn btn-outline-secondary w-50"
							@click="moveItem(item.id)"
						>
							Move Down
						</button>
						<button
							class="btn btn-outline-secondary w-50"
							@click="moveItemUp(item.id)"
						>
							Move Up
						</button>

						<button
							class="btn btn-outline-secondary w-50"
							@click="deleteItem(item.id)"
						>
							Delete
						</button>
					</div>
				</span>

				<button
					class="btn btn-outline-success mb-5 w-100 save"
					@click="showContentSideBar = false"
				>
					Save
				</button>
			</div>
		</div>
	</transition>

	<add-content :layouts="layouts" :items="items"></add-content>
</template>

<style>
.jodit-workplace {
	height: 300px !important;
}
</style>
