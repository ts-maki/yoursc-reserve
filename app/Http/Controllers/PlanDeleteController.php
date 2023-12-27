        $plan = Plan::with('planReserveSlots.reserveSlot.room',)->findOrFail($plan_id);
