import { Component } from '@angular/core';
import { email } from '@angular/forms/signals';
import { EditUser } from '../../../modals/Users/edit-user/edit-user';

@Component({
  selector: 'app-users-table',
  standalone: true,
  imports: [EditUser],
  templateUrl: './users-table.html',
  styleUrl: './users-table.css',
})
export class UsersTable {
 users = [
  {
    id: 1,
    name: 'John Doe',
    email: 'John@gmail.com',
  },
  {
    id: 2,
    name: 'Jane Doe',
    email: 'Jane@gmail.com',
  },
 ];
}
