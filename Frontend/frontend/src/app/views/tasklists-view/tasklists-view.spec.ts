import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TasklistsView } from './tasklists-view';

describe('TasklistsView', () => {
  let component: TasklistsView;
  let fixture: ComponentFixture<TasklistsView>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [TasklistsView]
    })
    .compileComponents();

    fixture = TestBed.createComponent(TasklistsView);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
