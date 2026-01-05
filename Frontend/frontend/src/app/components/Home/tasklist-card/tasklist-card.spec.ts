import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TasklistCard } from './tasklist-card';

describe('TasklistCard', () => {
  let component: TasklistCard;
  let fixture: ComponentFixture<TasklistCard>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [TasklistCard]
    })
    .compileComponents();

    fixture = TestBed.createComponent(TasklistCard);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
