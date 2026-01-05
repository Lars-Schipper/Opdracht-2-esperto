import { Routes } from '@angular/router';
import { HomeView } from './views/home-view/home-view';
import { UsersView } from './views/users-view/users-view';
import { UserView } from './views/user-view/user-view';
import { TaskView } from './views/task-view/task-view';
import { TasklistsView } from './views/tasklists-view/tasklists-view';

export const routes: Routes = [
    {
    path: '',
    component: HomeView,
    title: 'home',
  },
  {
    path: 'users',
    component: UsersView,
    title: 'users',
  },
  {
    path: 'user',
    component: UserView,
    title: 'user',
  },
  {
    path: 'task',
    component: TaskView,
    title: 'task',
  },
  {
    path: 'tasklists',
    component: TasklistsView,
    title: 'tasklists',
  },
];
