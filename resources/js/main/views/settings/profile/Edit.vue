<template>
	<AdminPageHeader>
		<template #header>
			<a-page-header :title="$t(`menu.my_account`)" class="p-0">
				<template #extra>
					<a-button type="primary" @click="onSubmit">
						<template #icon> <SaveOutlined /> </template>
						{{ $t("common.update") }}
					</a-button>
				</template>
			</a-page-header>
		</template>
		<template #breadcrumb>
			<a-breadcrumb separator="-" style="font-size: 12px">
				<a-breadcrumb-item>
					<router-link :to="{ name: 'admin.dashboard.index' }">
						{{ $t(`menu.dashboard`) }}
					</router-link>
				</a-breadcrumb-item>
				<a-breadcrumb-item>
					{{ $t("menu.settings") }}
				</a-breadcrumb-item>
				<a-breadcrumb-item>
					{{ $t("menu.my_account") }}
				</a-breadcrumb-item>
			</a-breadcrumb>
		</template>
	</AdminPageHeader>

	<a-row>
		<a-col :xs="24" :sm="24" :md="24" :lg="4" :xl="4" class="bg-setting-sidebar">
			<SettingSidebar />
		</a-col>
		<a-col :xs="24" :sm="24" :md="24" :lg="20" :xl="20">
			<a-card class="page-content-container">
				<a-form layout="vertical">
					<a-typography-title :level="4">{{ $t('user.profile_picture') }}</a-typography-title>
					<a-row :gutter="16">
						<a-col :xs="24" :sm="24" :md="24" :lg="24">
							<a-form-item
								name="profile_image"
								:help="
									rules.profile_image
										? rules.profile_image.message
										: null
								"
								:validateStatus="rules.profile_image ? 'error' : null"
							>
								<Upload
									:formData="formData"
									folder="user"
									imageField="profile_image"
									@onFileUploaded="
										(file) => {
											formData.profile_image = file.file;
											formData.profile_image_url = file.file_url;
										}
									"
								/>
							</a-form-item>
						</a-col>
					</a-row>

					<a-row :gutter="16">
						<a-col :xs="24" :sm="24" :md="12" :lg="12">
							<a-form-item
								:label="$t('user.first_name')"
								name="firstname"
								:help="rules.firstname ? rules.firstname.message : null"
								:validateStatus="rules.firstname ? 'error' : null"
								class="required"
							>
								<a-input
									v-model:value="formData.firstname"
									:placeholder="
										$t('common.placeholder_default_text', [
											$t('user.first_name'),
										])
									"
								/>
							</a-form-item>
						</a-col>
						<a-col :xs="24" :sm="24" :md="12" :lg="12">
							<a-form-item
								:label="$t('user.last_name')"
								name="lastname"
								:help="rules.lastname ? rules.lastname.message : null"
								:validateStatus="rules.lastname ? 'error' : null"
								class="required"
							>
								<a-input
									v-model:value="formData.lastname"
									:placeholder="
										$t('common.placeholder_default_text', [
											$t('user.last_name'),
										])
									"
								/>
							</a-form-item>
						</a-col>
					</a-row>

					<a-row :gutter="16">
						<a-col :xs="24" :sm="24" :md="12" :lg="12">
							<a-form-item
								:label="$t('user.email')"
								name="email"
								:help="rules.email ? rules.email.message : null"
								:validateStatus="rules.email ? 'error' : null"
								class="required"
							>
								<a-input
									:value="formData.email"
									:placeholder="
										$t('common.placeholder_default_text', [
											$t('user.email'),
										])
									"
									disabled
								/>
							</a-form-item>
						</a-col>
						<a-col :xs="24" :sm="24" :md="12" :lg="12">
							<a-form-item
								:label="$t('user.phone')"
								name="phone"
								:help="rules.phone ? rules.phone.message : null"
								:validateStatus="rules.phone ? 'error' : null"
							>
								<a-input
									v-model:value="formData.phone"
									:placeholder="
										$t('common.placeholder_default_text', [
											$t('user.phone'),
										])
									"
								/>
							</a-form-item>
						</a-col>
					</a-row>

					<a-typography-title :level="4">Change password</a-typography-title>
					<a-row :gutter="16">
						<a-col :xs="24" :sm="24" :md="12" :lg="12">
							<a-form-item
								:label="$t('user.current_password')"
								name="current_password"
								:help="rules.current_password ? rules.current_password.message : null"
								:validateStatus="rules.current_password ? 'error' : null"
							>
								<a-input
									v-model:value="formData.current_password"
									:placeholder="
										$t('common.placeholder_default_text', [
											$t('user.current_password'),
										])
									"
									type="password"
									autocomplete="off"
								/>
							</a-form-item>
						</a-col>
						<a-col :xs="24" :sm="24" :md="12" :lg="12">
							<a-form-item
								:label="$t('user.new_password')"
								name="new_password"
								:help="rules.new_password ? rules.new_password.message : null"
								:validateStatus="rules.new_password ? 'error' : null"
							>
								<a-input
									v-model:value="formData.new_password"
									:placeholder="
										$t('common.placeholder_default_text', [
											$t('user.new_password'),
										])
									"
									type="password"
									autocomplete="off"
								/>
							</a-form-item>
						</a-col>
					</a-row>

					<a-typography-title :level="4">Auto-logout</a-typography-title>
					<a-row :gutter="16">
						<a-col :xs="24" :sm="24" :md="24" :lg="24">
							<a-form-item
								:label="$t('user.auto_logout')"
								name="auto_logout"
								:help="
									rules.auto_logout
										? rules.auto_logout.message
										: null
								"
								:validateStatus="
									rules.auto_logout ? 'error' : null
								"
							>
								<a-select
									v-model:value="formData.auto_logout"
									:placeholder="
										$t('common.select_default_text', [
											$t('user.auto_logout'),
										])
									"
								>
									<a-select-option key="never" :value="1440">
										{{ $t("user.never") }}
									</a-select-option>
									<a-select-option key="one_minute" :value="1">
										{{ $t("user.one_minute") }}
									</a-select-option>
									<a-select-option key="five_minutes" :value="5">
										{{ $t("user.five_minutes") }}
									</a-select-option>
									<a-select-option key="ten_minutes" :value="10">
										{{ $t("user.ten_minutes") }}
									</a-select-option>
									<a-select-option key="thirty_minutes" :value="30">
										{{ $t("user.thirty_minutes") }}
									</a-select-option>
									<a-select-option key="one_hour" :value="60">
										{{ $t("user.one_hour") }}
									</a-select-option>
								</a-select>
							</a-form-item>
						</a-col>
					</a-row>

					<a-typography-title :level="4">Logged in devices</a-typography-title>
					<a-row :gutter="16">
						<a-col :xs="24" :sm="24" :md="24" :lg="24">
							<a-table :columns="columns" :data-source="dataSource">
								<template @action="{text, record, index}">
									<a-button @click="logout()">Log out</a-button>
								</template>
							</a-table>
						</a-col>
					</a-row>

					<a-row :gutter="16">
						<a-col :xs="24" :sm="24" :md="24" :lg="24">
							<a-form-item>
								<a-button
									type="primary"
									@click="onSubmit"
									:loading="loading"
								>
									<template #icon> <SaveOutlined /> </template>
									{{ $t("common.update") }}
								</a-button>
							</a-form-item>
						</a-col>
					</a-row>
				</a-form>
			</a-card>
		</a-col>
	</a-row>
</template>
<script>
import { onMounted, onBeforeMount, ref } from "vue";
import {
	EyeOutlined,
	PlusOutlined,
	EditOutlined,
	DeleteOutlined,
	ExclamationCircleOutlined,
	SaveOutlined,
} from "@ant-design/icons-vue";
import { useI18n } from "vue-i18n";
import { useStore } from "vuex";
import apiAdmin from "../../../../common/composable/apiAdmin";
import Upload from "../../../../common/core/ui/file/Upload.vue";
import SettingSidebar from "../SettingSidebar.vue";
import AdminPageHeader from "../../../../common/layouts/AdminPageHeader.vue";

export default {
	components: {
		EyeOutlined,
		PlusOutlined,
		EditOutlined,
		DeleteOutlined,
		ExclamationCircleOutlined,
		SaveOutlined,

		Upload,
		SettingSidebar,
		AdminPageHeader,
	},
	setup() {
		const { addEditRequestAdmin, loading, rules } = apiAdmin();
		const { t } = useI18n();
		const store = useStore();
		const formData = ref({});
		const currencies = ref({});
		const user = store.state.auth.user;

		const columns = [
			{
				title: 'Device',
				dataIndex: 'device',
				key: 'device'
			},
			{
				title: 'Last Activity Time',
				dataIndex: 'last_activity_time',
				key: 'last_activity_time'
			},
			{
				title: 'Action',
				key: 'logout',
				dataIndex: 'action',
				scopedSlots: { customRender: 'action'}
			}
		];
		const dataSource = ref([]);

		onMounted(() => {
			formData.value = {
				firstname: user.firstname,
				lastname: user.lastname,
				email: user.email,
				new_password: "",
				current_password: "",
				phone: user.phone,
				profile_image: user.profile_image,
				profile_image_url: user.profile_image_url,
				auto_logout: user.auto_logout ? user.auto_logout : 0
			};
		});

		onBeforeMount(() => {
			axiosAdmin
				.get('loggeddevices')
				.then(response => {
					dataSource.value = response.map((item, index) => {
						return {
							key: '1',
							device: item.browser + ' on ' + item.platform,
							last_activity_time: item.last_activity,
						}
					})
				})
		});

		const onSubmit = () => {
			addEditRequestAdmin({
				url: `profile`,
				data: formData.value,
				successMessage: t("user.profile_updated"),
				success: (res) => {
					store.commit("auth/updateUser", res.user);
				},
			});
		};

		return {
			loading,
			rules,
			formData,
			currencies,
			onSubmit,
			columns,
			dataSource,
		};
	},
	methods: {
		logout(record) {
			
		}
	}
};
</script>
