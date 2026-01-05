import { Component } from '@angular/core';
import { Input } from '@angular/core';

@Component({
  selector: 'app-tasklist-card',
  standalone: true,
  imports: [],
  templateUrl: './tasklist-card.html',
  styleUrl: './tasklist-card.css',
})
export class TasklistCard {
  @Input() name = '';
  @Input() description = '';
  @Input() amountOfTasks = 0;
  @Input() owner = '';
}
