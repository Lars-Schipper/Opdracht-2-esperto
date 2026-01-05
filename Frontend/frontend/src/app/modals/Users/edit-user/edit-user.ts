import { Component, inject, signal, TemplateRef, WritableSignal } from '@angular/core';
import { FormControl, ReactiveFormsModule } from '@angular/forms';

import { ModalDismissReasons, NgbModal } from '@ng-bootstrap/ng-bootstrap/modal';


@Component({
  selector: 'app-edit-user',
  standalone: true,
  imports: [ReactiveFormsModule],
  templateUrl: './edit-user.html',
  styleUrl: './edit-user.css',
})
export class EditUser {
  name = new FormControl('');
  email = new FormControl('');

  private modalService = inject(NgbModal);
  closeResult: WritableSignal<string> = signal('');

  open(content: TemplateRef<any>) {
    this.modalService.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then(
      (result) => {
        this.closeResult.set(`Closed with: ${result}`);
      },
    );
  };
}
