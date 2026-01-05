import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DeleteAllUsers } from './delete-all-users';

describe('DeleteAllUsers', () => {
  let component: DeleteAllUsers;
  let fixture: ComponentFixture<DeleteAllUsers>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DeleteAllUsers]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DeleteAllUsers);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
