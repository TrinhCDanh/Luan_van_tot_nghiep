import Layout from './components/Layout'
import Home from './components/trangchu/Home'

// Quản lý học kỳ
import HockyList from './components/hocky/HockyList'
import HockyAdd from './components/hocky/HockyAdd'
import HockyEdit from './components/hocky/HockyEdit'

// Quản lý ca trực, ca dạy

// Quản lý thứ trong tuần


export const routes = [
	{ path: '/', component: Layout, name: 'Layout', children: [
		{ path: '/giangvien/home', component: Home, name: 'Home' },
		{ path: '/giangvien/hocky', component: HockyList, name: 'HockyList' },
		{ path: '/giangvien/hocky/add', component: HockyAdd, name: 'HockyAdd'},
		{ path: '/giangvien/hocky/edit/:id', component: HockyEdit, name: 'HockyEdit'}
	]}
	
	// { path: '/giangvien/hocky/edit/:id', component: HockyEdit, name: 'HockyEdit'}
];