import { Component } from '@angular/core';
import { Card } from '../../components/Home/card/card';
import { TasklistCard } from '../../components/Home/tasklist-card/tasklist-card';

@Component({
  selector: 'app-home-view',
  standalone: true,
  imports: [Card, TasklistCard],
  templateUrl: './home-view.html',
  styleUrl: './home-view.css',
})
export class HomeView {
  users = {
    type: 'total amount of users',
    amount: 3,
  };

  tasks = {
    type: 'total amount of tasks',
    amount: 5,
  };

  uncompletedTask = {
    type: 'uncompleted tasks',
    amount: 3,
  };

  tasklist = {
    type: 'total amount of tasklists',
    amount: 3,
  }

  tasklists = [
    {
      name: 'Website project',
      description: 'Task for the new website project',
      amountOfTasks: 2,
      owner: 'lars'
    },
    {
      name: 'Marketing Campaign',
      description: 'Social media marketing task',
      amountOfTasks: 4,
      owner: 'lars'
    },
    {
      name: 'bug fixes',
      description: 'Bugs that should be fixed',
      amountOfTasks: 1,
      owner: 'lars'
    },
  ]
}
