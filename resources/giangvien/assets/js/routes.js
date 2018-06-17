import Layout from './components/Layout'
import Home from './components/trangchu/Home'

// Quản lý học kỳ
import HockyList from './components/hocky/HockyList'
import HockyAdd from './components/hocky/HockyAdd'
import HockyEdit from './components/hocky/HockyEdit'

// Quản lý ca trực, ca dạy
import CaList from './components/ca/CaList'
import CaAdd from './components/ca/CaAdd'
import CaEdit from './components/ca/CaEdit'

// Quản lý thứ trong tuần
import ThuList from './components/thu/ThuList'
import ThuAdd from './components/thu/ThuAdd'
import ThuEdit from './components/thu/ThuEdit'

// Quản lý phòng máy
import PhongmayList from './components/phongmay/PhongmayList'
import PhongmayAdd from './components/phongmay/PhongmayAdd'
import PhongmayEdit from './components/phongmay/PhongmayEdit'

//import MayListStatus from './components/may/MayListStatus'
import MayList from './components/may/MayList'
import MayPhongmayList from './components/may/MayPhongmayList';
import MayListStatus from './components/may/MayListStatus';

// Quản lý thông tin ds lớp
// import LopList from './components/lop/LopList'
// import LopAdd from './components/lop/LopAdd'
// import LopEdit from './components/lop/LopEdit'

// Quản lý thông tin môn học
// import MonhocList from './components/monhoc/MonhocList'
// import MonhocAdd from './components/monhoc/MonhocAdd'
// import MonhocEdit from './components/monhoc/MonhocEdit'

// Quản lý kỹ thuật viên
// import giangvienList from './components/giangvien/giangvienList'
// import giangvienAdd from './components/giangvien/giangvienAdd'
//import giangvienEdit from './components/giangvien/giangvienEdit'

// Quản lý lịch trực
import LichtrucList from './components/lichtruc/LichtrucList'
import LichtrucAdd from './components/lichtruc/LichtrucAdd'
import LichtrucEdit from './components/lichtruc/LichtrucEdit'

// Quản lý tình trạng máy
import TinhtrangList from './components/tinhtrangmay/TinhtrangList'
import TinhtrangAdd from './components/tinhtrangmay/TinhtrangAdd'
import TinhtrangEdit from './components/tinhtrangmay/TinhtrangEdit'
import TinhtrangView from './components/tinhtrangmay/TinhtrangView'

// Quản lý tài khoản
import TaikhoanEdit from './components/taikhoan/TaikhoanEdit'


export const routes = [
	{ path: '/', component: Layout, name: 'Layout', children: [
		{ path: '/giangvien/home', component: Home, name: 'Home' },

		// { path: '/giangvien/hocky', component: HockyList, name: 'HockyList' },
		// { path: '/giangvien/hocky/add', component: HockyAdd, name: 'HockyAdd'},
		// { path: '/giangvien/hocky/edit/:id', component: HockyEdit, name: 'HockyEdit'},

		// { path: '/giangvien/ca', component: CaList, name: 'CaList' },
		// { path: '/giangvien/ca/add', component: CaAdd, name: 'CaAdd' },
		// { path: '/giangvien/ca/edit/:id', component: CaEdit, name: 'CaEdit' },

		// { path: '/giangvien/thu', component: ThuList, name: 'ThuList' },
		// { path: '/giangvien/thu/add', component: ThuAdd, name: 'ThuAdd' },
		// { path: '/giangvien/thu/edit/:id', component: ThuEdit, name: 'ThuEdit' },

		{ path: '/giangvien/phongmay', component: PhongmayList, name: 'PhongmayList' },
		{ path: '/giangvien/phongmay/add', component: PhongmayAdd, name: 'PhongmayAdd' },
		{ path: '/giangvien/phongmay/edit/:id', component: PhongmayEdit, name: 'PhongmayEdit' },
		{ path: '/giangvien/phongmay/may/:idphong', component: MayList, name: 'MayList' },

		{ path: '/giangvien/may', component: MayPhongmayList, name: 'MayPhongmayList'},
		{ path: '/giangvien/may/phongmay/:idphong', component: MayListStatus, name: 'MayListStatus'},

		{ path: '/giangvien/tinhtrangmay/:may_slug', component: TinhtrangList, name: 'TinhtrangList' },
		{ path: '/giangvien/tinhtrangmay/:may_slug/add', component: TinhtrangAdd, name: 'TinhtrangAdd' },
		{ path: '/giangvien/tinhtrangmay/:may_slug/edit/:id', component: TinhtrangEdit, name: 'TinhtrangEdit' },
		{ path: '/giangvien/tinhtrangmay/:may_slug/view/:id', component: TinhtrangView, name: 'TinhtrangView' },

		// { path: '/giangvien/lop', component: LopList, name: 'LopList' },
		// { path: '/giangvien/lop/add', component: LopAdd, name: 'LopAdd'},
		// { path: '/giangvien/lop/edit/:id', component: LopEdit, name: 'LopEdit'},

		// { path: '/giangvien/monhoc', component: MonhocList, name: 'MonhocList' },
		// { path: '/giangvien/monhoc/add', component: MonhocAdd, name: 'MonhocAdd'},
		// { path: '/giangvien/monhoc/edit/:id', component: MonhocEdit, name: 'MonhocEdit'},

		// { path: 'giangvien/giangvien', component: giangvienList, name: 'giangvienList' },
		// { path: 'giangvien/giangvien/add', component: giangvienAdd, name: 'giangvienAdd' },
		// { path: 'amdin/giangvien/edit/:id', component: giangvienEdit, name: 'giangvienEdit' },

		{ path: '/giangvien/lichtruc', component: LichtrucList, name: 'LichtrucList' },
		{ path: '/giangvien/lichtruc/add', component: LichtrucAdd, name: 'LichtrucAdd' },
		{ path: '/giangvien/lichtruc/edit/:id', component: LichtrucEdit, name: 'LichtrucEdit' },

		{ path: '/giangvien/taikhoan/edit', component: TaikhoanEdit, name: 'TaikhoanEdit' },
	]}

	// { path: '/giangvien/hocky/edit/:id', component: HockyEdit, name: 'HockyEdit'}
];