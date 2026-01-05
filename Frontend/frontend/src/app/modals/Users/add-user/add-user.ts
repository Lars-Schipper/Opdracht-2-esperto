import { Component, inject, signal, TemplateRef, WritableSignal } from '@angular/core';
import { FormControl, ReactiveFormsModule } from '@angular/forms';

import { ModalDismissReasons, NgbModal } from '@ng-bootstrap/ng-bootstrap/modal';

@Component({
  selector: 'app-add-user',
  standalone: true,
  imports: [ReactiveFormsModule],
  templateUrl: './add-user.html',
  styleUrl: './add-user.css',
})
export class AddUser {
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
