import { Component } from '@angular/core';
import { DeleteAllUsers } from '../../modals/Users/delete-all-users/delete-all-users';
import { AddUser } from '../../modals/Users/add-user/add-user';
import { UsersTable } from "../../components/users/users-table/users-table";

@Component({
  selector: 'app-users-view',
  standalone: true,
  imports: [DeleteAllUsers, AddUser, UsersTable, UsersTable],
  templateUrl: './users-view.html',
  styleUrl: './users-view.css',
})
export class UsersView {

}
