import { Objects } from '@ephox/boulder';

import * as EventRoot from '../../alien/EventRoot';
import { AlloyComponent } from '../../api/component/ComponentApi';
import * as EventHandler from '../../construct/EventHandler';
import { EventFormat, SimulatedEvent } from '../../events/SimulatedEvent';
import * as AlloyTriggers from './AlloyTriggers';
import * as SystemEvents from './SystemEvents';
import * as TransformFind from '../../alien/TransformFind';
import { Fun } from '@ephox/katamari';

export type AlloyEventRecord = Record<string, AlloyEventHandler<EventFormat>>;

export interface AlloyEventHandler<T extends EventFormat> {
  can: () => boolean;
  abort: () => boolean;
  run: EventRunHandler<T>;
}

export interface AlloyEventKeyAndHandler<T extends EventFormat> {
  key: string;
  value: AlloyEventHandler<T>;
}

type RunOnName<T extends EventFormat> = (handler: EventRunHandler<T>) => AlloyEventKeyAndHandler<T>;
type RunOnSourceName<T extends EventFormat> = (handler: EventRunHandler<T>) => AlloyEventKeyAndHandler<T>;
export type EventRunHandler<T extends EventFormat> = (component: AlloyComponent, se: SimulatedEvent<T>, ...others) => void;

export type EventAbortHandler<T extends EventFormat> = (comp: AlloyComponent, se: SimulatedEvent<T>) => boolean;

export type EventCanHandler<T extends EventFormat> = (comp: AlloyComponent, se: SimulatedEvent<T>) => boolean;

const derive = <A extends EventFormat>(configs: Array<AlloyEventKeyAndHandler<A>>): AlloyEventRecord => {
  return Objects.wrapAll(configs) as AlloyEventRecord;
};

// const combine = (configs...);

const abort = function <T extends EventFormat>(name: string, predicate: EventAbortHandler<T>): AlloyEventKeyAndHandler<T> {
  return {
    key: name,
    value: EventHandler.nu({
      abort: predicate
    })
  };
};

const can = function <T extends EventFormat>(name: string, predicate: EventCanHandler<T>): AlloyEventKeyAndHandler<T> {
  return {
    key: name,
    value: EventHandler.nu({
      can: predicate
    })
  };
};

const preventDefault = function <T extends EventFormat>(name: string): AlloyEventKeyAndHandler<T> {
  return {
    key: name,
    value: EventHandler.nu({
      run (component, simulatedEvent) {
        simulatedEvent.event().prevent();
      }
    })
  };
};

const run = function <T extends EventFormat>(name: string, handler: EventRunHandler<T>): AlloyEventKeyAndHandler<T> {
  return {
    key: name,
    value: EventHandler.nu({
      run: handler
    })
  };
};

// Extra can be used when your handler needs more context, and is declared in one spot
// It's really just convenient partial application.
const runActionExtra = function <T extends EventFormat>(name: string, action: (t: AlloyComponent, u: any) => void, extra: any): AlloyEventKeyAndHandler<T> {
  return {
    key: name,
    value: EventHandler.nu({
      run (component) {
        action.apply(undefined, [ component ].concat(extra));
      }
    })
  };
};

const runOnName = function <T extends EventFormat>(name): RunOnName<T> {
  return (handler) => {
    return run(name, handler);
  };
};

const runOnSourceName = function <T extends EventFormat>(name): RunOnSourceName<T> {
  return (handler: (component: AlloyComponent, simulatedEvent: SimulatedEvent<T>) => void): AlloyEventKeyAndHandler<T> => {
    return {
      key: name,
      value: EventHandler.nu({
        run (component, simulatedEvent: SimulatedEvent<T>) {
          if (EventRoot.isSource(component, simulatedEvent)) { handler(component, simulatedEvent); }
        }
      })
    };
  };
};

const redirectToUid = function <T extends EventFormat>(name, uid): AlloyEventKeyAndHandler<T> {
  return run(name, (component: AlloyComponent, simulatedEvent: SimulatedEvent<T>) => {
    component.getSystem().getByUid(uid).each((redirectee) => {
      AlloyTriggers.dispatchEvent(redirectee, redirectee.element(), name, simulatedEvent);
    });
  });
};

const redirectToPart = function <T extends EventFormat>(name, detail, partName): AlloyEventKeyAndHandler<T> {
  const uid = detail.partUids[partName];
  return redirectToUid(name, uid);
};

const runWithTarget = function <T extends EventFormat>(name, f): AlloyEventKeyAndHandler<T> {
  return run(name, (component, simulatedEvent) => {
    const ev: T = simulatedEvent.event();

    const target = component.getSystem().getByDom(ev.target()).fold(
      // If we don't find an alloy component for the target, I guess we go up the tree
      // until we find an alloy component? Performance concern?
      // TODO: Write tests for this.
      () => {
        const closest = TransformFind.closest(ev.target(), (el) => {
          return component.getSystem().getByDom(el).toOption();
        }, Fun.constant(false));

        // If we still found nothing ... fire on component itself;
        return closest.getOr(component);
      },
      (c) => c
    );

    f(component, target, simulatedEvent);
  });
};

const cutter = function <T extends EventFormat>(name): AlloyEventKeyAndHandler<T> {
  return run(name, (component, simulatedEvent) => {
    simulatedEvent.cut();
  });
};

const stopper = function <T extends EventFormat>(name): AlloyEventKeyAndHandler<T> {
  return run(name, (component, simulatedEvent) => {
    simulatedEvent.stop();
  });
};

const runOnSource = function <T extends EventFormat>(name: string, f: EventRunHandler<T>): AlloyEventKeyAndHandler<T> {
  return runOnSourceName(name)(f);
};

const runOnAttached = runOnSourceName(SystemEvents.attachedToDom());
const runOnDetached = runOnSourceName(SystemEvents.detachedFromDom());
const runOnInit = runOnSourceName(SystemEvents.systemInit());
const runOnExecute = runOnName(SystemEvents.execute());
export {
  derive,
  run,
  preventDefault,
  runActionExtra,
  runOnAttached,
  runOnDetached,
  runOnSource,
  runOnInit,
  runOnExecute,

  redirectToUid,
  redirectToPart,
  runWithTarget,
  abort,
  can,
  cutter,
  stopper
};