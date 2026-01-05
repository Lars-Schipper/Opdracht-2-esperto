import { Component } from '@angular/core';
import { RouterLink, RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-nav',
  standalone: true,
  imports: [RouterLink, RouterOutlet],
  templateUrl: './nav.html',
  styleUrl: './nav.css',
})
export class Nav {

}
