"""
Python model 'models.py'
Translated using PySD
"""

from pathlib import Path
import numpy as np

from pysd.py_backend.functions import if_then_else, not_implemented_function
from pysd.py_backend.statefuls import Integ
from pysd import Component

__pysd_version__ = "3.14.1"

__data = {"scope": None, "time": lambda: 0}

_root = Path(__file__).parent


component = Component()

#######################################################################
#                          CONTROL VARIABLES                          #
#######################################################################

_control_vars = {
    "initial_time": lambda: 1,
    "final_time": lambda: 132,
    "time_step": lambda: 1,
    "saveper": lambda: time_step(),
}


def _init_outer_references(data):
    for key in data:
        __data[key] = data[key]


@component.add(name="Time")
def time():
    """
    Current time of the model.
    """
    return __data["time"]()


@component.add(
    name="FINAL TIME", units="Month", comp_type="Constant", comp_subtype="Normal"
)
def final_time():
    """
    The final time for the simulation.
    """
    return __data["time"].final_time()


@component.add(
    name="INITIAL TIME", units="Month", comp_type="Constant", comp_subtype="Normal"
)
def initial_time():
    """
    The initial time for the simulation.
    """
    return __data["time"].initial_time()


@component.add(
    name="SAVEPER",
    units="Month",
    limits=(0.0, np.nan),
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time_step": 1},
)
def saveper():
    """
    The frequency with which output is stored.
    """
    return __data["time"].saveper()


@component.add(
    name="TIME STEP",
    units="Month",
    limits=(0.0, np.nan),
    comp_type="Constant",
    comp_subtype="Normal",
)
def time_step():
    """
    The time step for the simulation.
    """
    return __data["time"].time_step()


#######################################################################
#                           MODEL VARIABLES                           #
#######################################################################


@component.add(
    name="Workforce Quality",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1, "effect_of_billateral_cooperation": 1},
)
def workforce_quality():
    return np.random.uniform(1, 5, size=()) - effect_of_billateral_cooperation()


@component.add(
    name="Effect of Billateral Cooperation",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1, "economic_approach_with_china": 1},
)
def effect_of_billateral_cooperation():
    return if_then_else(time() > 60, lambda: economic_approach_with_china(), lambda: 0)


@component.add(
    name="Military Impact",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "north_natuna_defense_and_security": 1,
        "effect_of_billateral_cooperation": 1,
    },
)
def military_impact():
    return north_natuna_defense_and_security() + effect_of_billateral_cooperation() ** 2


@component.add(
    name="Global Defense Partnership",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 2},
)
def global_defense_partnership():
    return if_then_else(
        time() > 61, lambda: np.random.uniform(1, 2, size=()), lambda: 0
    )


@component.add(
    name="Modernization and Acquisition of Warships",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def modernization_and_acquisition_of_warships():
    return if_then_else(time() > 60, lambda: 15, lambda: 0)


@component.add(
    name="Economic Approach with China",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def economic_approach_with_china():
    return np.random.uniform(1, 3, size=())


@component.add(
    name="Defense Capability",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1, "global_defense_partnership": 1},
)
def defense_capability():
    return (np.random.uniform(2, 3, size=()) + global_defense_partnership()) * 20


@component.add(
    name="Maritime Surveillance",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1, "effect_of_billateral_cooperation": 1},
)
def maritime_surveillance():
    return np.random.uniform(1, 5, size=()) + effect_of_billateral_cooperation()


@component.add(
    name="Warships Strength",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "patroling": 1,
        "striking": 1,
        "supporting": 1,
        "modernization_and_acquisition_of_warships": 1,
    },
)
def warships_strength():
    return (
        patroling() * 0.3
        + striking() * 0.5
        + supporting() * 0.2
        + modernization_and_acquisition_of_warships()
    )


@component.add(
    name="Defense Budgeting",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "potential_economic_value_of_north_natuna_sea": 1,
        "state_revenue_tax": 1,
    },
)
def defense_budgeting():
    return (
        (potential_economic_value_of_north_natuna_sea() + state_revenue_tax())
        / 2233200000000000.0
    ) * 100


@component.add(
    name='"Non-Tax Indonesia State Income"',
    units="Rupiah/Percentage",
    comp_type="Constant",
    comp_subtype="Normal",
)
def nontax_indonesia_state_income():
    return 514000000000000.0


@component.add(
    name="Naval Capabilities",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "defense_capability": 1,
        "diplomacy_ability": 1,
        "support_capabilities": 1,
        "intelligence_ability": 1,
        "regional_empowerment_capabilities": 1,
        "national_defense_and_security_infrastructure": 1,
    },
)
def naval_capabilities():
    return (
        defense_capability() * 0.25
        + diplomacy_ability() * 0.25
        + support_capabilities() * 0.1
        + intelligence_ability() * 0.1
        + regional_empowerment_capabilities() * 0.1
        + national_defense_and_security_infrastructure() * 0.2
    )


@component.add(
    name="Marine Resource Utilization",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "financial_impact": 1,
        "human_resource_impact": 1,
        "physical_impact": 1,
        "technological_impact": 1,
        "military_impact": 1,
    },
)
def marine_resource_utilization():
    return (
        financial_impact() * 0.25
        + human_resource_impact() * 0.15
        + physical_impact() * 0.1
        + technological_impact() * 0.2
        + military_impact() * 0.3
    )


@component.add(
    name="North Natuna Sea Stability",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"north_natuna_defense_and_security": 1},
)
def north_natuna_sea_stability():
    return north_natuna_defense_and_security() / 100


@component.add(
    name="Financial Impact",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "potential_economic_value_of_north_natuna_sea": 1,
        "nontax_indonesia_state_income": 1,
        "time": 2,
    },
)
def financial_impact():
    return if_then_else(
        (
            potential_economic_value_of_north_natuna_sea()
            / nontax_indonesia_state_income()
        )
        * 100
        > 25,
        lambda: np.random.uniform(51, 100, size=()),
        lambda: np.random.uniform(0, 51, size=()),
    )


@component.add(
    name="Natural Gas Prices",
    units="Rupiah/TCF",
    comp_type="Constant",
    comp_subtype="Normal",
)
def natural_gas_prices():
    return 4200000000000.0


@component.add(
    name="Natural Gas Reserves Utilization",
    units="TCF/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "discovery_of_new_natural_gas_reserves_within_the_area": 1,
        "utilization_of_gas_within_the_area": 1,
    },
)
def natural_gas_reserves_utilization():
    return (
        discovery_of_new_natural_gas_reserves_within_the_area()
        - utilization_of_gas_within_the_area()
    )


@component.add(
    name="Discovery of New Oil Reserves within the Area",
    units="Barrel/Month",
    comp_type="Constant",
    comp_subtype="Normal",
)
def discovery_of_new_oil_reserves_within_the_area():
    return 0


@component.add(
    name="North Natuna Oil Reserves",
    units="Barrel",
    comp_type="Stateful",
    comp_subtype="Integ",
    depends_on={"_integ_north_natuna_oil_reserves": 1},
    other_deps={
        "_integ_north_natuna_oil_reserves": {
            "initial": {},
            "step": {"oil_reserves_utilization": 1},
        }
    },
)
def north_natuna_oil_reserves():
    return _integ_north_natuna_oil_reserves()


_integ_north_natuna_oil_reserves = Integ(
    lambda: oil_reserves_utilization(),
    lambda: 14000000.0,
    "_integ_north_natuna_oil_reserves",
)


@component.add(
    name="Amount of Natural Gas Discovered in the BLock",
    units="TCF",
    comp_type="Constant",
    comp_subtype="Normal",
)
def amount_of_natural_gas_discovered_in_the_block():
    return 222


@component.add(name="Oil Prices", comp_type="Constant", comp_subtype="Normal")
def oil_prices():
    """
    RANDOM PINK NOISE(1.00093e+06, 221865, 15, 1 )RANDOM NORMAL(360000 , 1.4e+06 , 1.00093e+06 , 221865, 1)
    """
    return not_implemented_function("random_pink_noise", 1000930.0, 221865, 20, 1)


@component.add(
    name="Oil Reserves Utilization",
    units="Barrel/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "discovery_of_new_oil_reserves_within_the_area": 1,
        "utilization_of_oil_within_the_area": 1,
    },
)
def oil_reserves_utilization():
    return (
        discovery_of_new_oil_reserves_within_the_area()
        - utilization_of_oil_within_the_area()
    )


@component.add(
    name="Economic Values of Small Fish Catching",
    units="Rupiah",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "number_of_small_fish_catching": 1,
        "north_natuna_sea_stability": 1,
        "small_fish_market_price": 1,
    },
)
def economic_values_of_small_fish_catching():
    return (
        number_of_small_fish_catching() * north_natuna_sea_stability()
    ) * small_fish_market_price()


@component.add(
    name="Potential Economic Value of North Natuna Sea",
    units="Rupiah",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "economic_value_of_fisheries": 1,
        "potential_economic_value_of_oil_and_gas": 1,
    },
)
def potential_economic_value_of_north_natuna_sea():
    return economic_value_of_fisheries() + potential_economic_value_of_oil_and_gas()


@component.add(
    name="Economic Values of Lobsters and Shrimp Catching",
    units="Rupiah",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "number_of_shrimp_and_lobsters_catching": 1,
        "north_natuna_sea_stability": 1,
        "shrimp_and_lobsters_market_price": 1,
    },
)
def economic_values_of_lobsters_and_shrimp_catching():
    return (
        number_of_shrimp_and_lobsters_catching() * north_natuna_sea_stability()
    ) * shrimp_and_lobsters_market_price()


@component.add(
    name='"Block D-Alpha Natural Gas Reserves"',
    units="TCF",
    comp_type="Stateful",
    comp_subtype="Integ",
    depends_on={"_integ_block_dalpha_natural_gas_reserves": 1},
    other_deps={
        "_integ_block_dalpha_natural_gas_reserves": {
            "initial": {"initial_value_of_block_dalpha_gas_reserves": 1},
            "step": {"natural_gas_reserves_utilization": 1},
        }
    },
)
def block_dalpha_natural_gas_reserves():
    return _integ_block_dalpha_natural_gas_reserves()


_integ_block_dalpha_natural_gas_reserves = Integ(
    lambda: natural_gas_reserves_utilization(),
    lambda: initial_value_of_block_dalpha_gas_reserves(),
    "_integ_block_dalpha_natural_gas_reserves",
)


@component.add(
    name="Ratio of Natural Gas in the Reserves",
    units="Dmnl",
    comp_type="Constant",
    comp_subtype="Normal",
)
def ratio_of_natural_gas_in_the_reserves():
    return 0.3


@component.add(
    name="Potential Value of Oil Reserves",
    units="Rupiah",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"north_natuna_oil_reserves": 1, "oil_prices": 1},
)
def potential_value_of_oil_reserves():
    return north_natuna_oil_reserves() * oil_prices()


@component.add(
    name='"Initial Value of Block D-Alpha Gas Reserves"',
    units="TCF",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "amount_of_natural_gas_discovered_in_the_block": 1,
        "ratio_of_natural_gas_in_the_reserves": 1,
    },
)
def initial_value_of_block_dalpha_gas_reserves():
    return (
        amount_of_natural_gas_discovered_in_the_block()
        * ratio_of_natural_gas_in_the_reserves()
    )


@component.add(
    name="Utilization of Gas within the area",
    units="TCF/Month",
    comp_type="Constant",
    comp_subtype="Normal",
)
def utilization_of_gas_within_the_area():
    return 0


@component.add(
    name="Utilization of Oil within the area",
    units="Barrel/Month",
    comp_type="Constant",
    comp_subtype="Normal",
)
def utilization_of_oil_within_the_area():
    return 0


@component.add(
    name="Potential Value of Natural Gas",
    units="Rupiah",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"block_dalpha_natural_gas_reserves": 1, "natural_gas_prices": 1},
)
def potential_value_of_natural_gas():
    return block_dalpha_natural_gas_reserves() * natural_gas_prices()


@component.add(
    name="Economic Values of Reef and Deep Sea Fish Catching",
    units="Rupiah",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "number_of_reef_and_deep_sea_fish_catching": 1,
        "north_natuna_sea_stability": 1,
        "reef_and_deep_sea_fish_market_price": 1,
    },
)
def economic_values_of_reef_and_deep_sea_fish_catching():
    return (
        number_of_reef_and_deep_sea_fish_catching() * north_natuna_sea_stability()
    ) * reef_and_deep_sea_fish_market_price()


@component.add(
    name="Discovery of New Natural Gas Reserves within the Area",
    units="TCF/Month",
    comp_type="Constant",
    comp_subtype="Normal",
)
def discovery_of_new_natural_gas_reserves_within_the_area():
    return 0


@component.add(
    name="Potential Economic Value of Oil and Gas",
    units="Rupiah",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "potential_value_of_natural_gas": 1,
        "potential_value_of_oil_reserves": 1,
        "north_natuna_sea_stability": 1,
    },
)
def potential_economic_value_of_oil_and_gas():
    return (
        potential_value_of_natural_gas() + potential_value_of_oil_reserves()
    ) * north_natuna_sea_stability()


@component.add(
    name="Age of Reef and Deep Sea Fish",
    units="Month",
    comp_type="Constant",
    comp_subtype="Normal",
)
def age_of_reef_and_deep_sea_fish():
    return 10 * 12


@component.add(
    name="Age of Shrimp and Lobsters",
    units="Month",
    comp_type="Constant",
    comp_subtype="Normal",
)
def age_of_shrimp_and_lobsters():
    return 15 * 12


@component.add(
    name="Age of Small Fish", units="Month", comp_type="Constant", comp_subtype="Normal"
)
def age_of_small_fish():
    return 5 * 12


@component.add(
    name="Rate of Reef and Deep Sea Fish Increase",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"reef_and_deep_sea_fish_increase": 1},
)
def rate_of_reef_and_deep_sea_fish_increase():
    return reef_and_deep_sea_fish_increase()


@component.add(
    name="Rate of Shrimp and Lobster Catching",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"shrimp_and_lobster_fishing_ratio": 1},
)
def rate_of_shrimp_and_lobster_catching():
    return shrimp_and_lobster_fishing_ratio()


@component.add(
    name="Rate of Shrimp and Lobster Increase",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"shrimp_and_lobster_increase": 1},
)
def rate_of_shrimp_and_lobster_increase():
    return shrimp_and_lobster_increase()


@component.add(
    name="Rate of Shrimp and Lobsters Decrease",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "rate_of_shrimp_and_lobster_catching": 1,
        "period_of_fishing": 1,
        "potential_number_of_shrimp_and_lobsters_in_the_sea": 1,
        "age_of_shrimp_and_lobsters": 1,
    },
)
def rate_of_shrimp_and_lobsters_decrease():
    return (
        rate_of_shrimp_and_lobster_catching() / period_of_fishing()
        + potential_number_of_shrimp_and_lobsters_in_the_sea()
        / age_of_shrimp_and_lobsters()
    )


@component.add(
    name="Rate of Small Fish Catching",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"small_fish_fishing_ratio": 1},
)
def rate_of_small_fish_catching():
    return small_fish_fishing_ratio()


@component.add(
    name="Rate of Small Fish Decrease",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "rate_of_small_fish_catching": 1,
        "period_of_fishing": 1,
        "potential_number_of_small_fish_in_the_sea": 1,
        "age_of_small_fish": 1,
    },
)
def rate_of_small_fish_decrease():
    return (
        rate_of_small_fish_catching() / period_of_fishing()
        + potential_number_of_small_fish_in_the_sea() / age_of_small_fish()
    )


@component.add(
    name="Rate of Small Fish Increase",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"small_fish_increase": 1},
)
def rate_of_small_fish_increase():
    return small_fish_increase()


@component.add(
    name="Reef and Deep Sea Fish Fishing Ratio",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "potential_number_of_reef_and_deep_sea_fish_in_the_sea": 1,
        "number_of_reef_and_deep_sea_fish_catching": 1,
        "time": 1,
    },
)
def reef_and_deep_sea_fish_fishing_ratio():
    return if_then_else(
        potential_number_of_reef_and_deep_sea_fish_in_the_sea()
        < number_of_reef_and_deep_sea_fish_catching(),
        lambda: 0,
        lambda: np.random.uniform(20000 / 12, 30000 / 12, size=()),
    )


@component.add(
    name="Reef and Deep Sea Fish Increase",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def reef_and_deep_sea_fish_increase():
    return np.random.uniform(100000 / 12, 150000 / 12, size=())


@component.add(
    name="Reef and Deep Sea Fish Market Price",
    units="Rupiah/ton",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def reef_and_deep_sea_fish_market_price():
    return np.random.uniform(45000000.0, 90000000.0, size=())


@component.add(
    name="Shrimp and Lobsters Market Price",
    units="Rupiah/ton",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def shrimp_and_lobsters_market_price():
    return np.random.uniform(100000000.0, 450000000.0, size=())


@component.add(
    name="Number of Reef and Deep Sea Fish Catching",
    units="ton",
    comp_type="Stateful",
    comp_subtype="Integ",
    depends_on={"_integ_number_of_reef_and_deep_sea_fish_catching": 1},
    other_deps={
        "_integ_number_of_reef_and_deep_sea_fish_catching": {
            "initial": {},
            "step": {"rate_of_reef_and_deep_sea_fish_catching": 1},
        }
    },
)
def number_of_reef_and_deep_sea_fish_catching():
    return _integ_number_of_reef_and_deep_sea_fish_catching()


_integ_number_of_reef_and_deep_sea_fish_catching = Integ(
    lambda: rate_of_reef_and_deep_sea_fish_catching(),
    lambda: 20000 / 12,
    "_integ_number_of_reef_and_deep_sea_fish_catching",
)


@component.add(
    name="Small Fish Increase",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def small_fish_increase():
    return np.random.uniform(200000 / 12, 300000 / 12, size=())


@component.add(
    name="Number of Small Fish Catching",
    units="ton",
    comp_type="Stateful",
    comp_subtype="Integ",
    depends_on={"_integ_number_of_small_fish_catching": 1},
    other_deps={
        "_integ_number_of_small_fish_catching": {
            "initial": {},
            "step": {"rate_of_small_fish_catching": 1},
        }
    },
)
def number_of_small_fish_catching():
    return _integ_number_of_small_fish_catching()


_integ_number_of_small_fish_catching = Integ(
    lambda: rate_of_small_fish_catching(),
    lambda: 100000 / 12,
    "_integ_number_of_small_fish_catching",
)


@component.add(
    name="Small Fish Fishing Ratio",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "potential_number_of_small_fish_in_the_sea": 1,
        "number_of_small_fish_catching": 1,
    },
)
def small_fish_fishing_ratio():
    return if_then_else(
        potential_number_of_small_fish_in_the_sea() < number_of_small_fish_catching(),
        lambda: 0,
        lambda: 100000 / 12,
    )


@component.add(
    name="Economic Value of Fisheries",
    units="Rupiah",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "economic_values_of_lobsters_and_shrimp_catching": 1,
        "economic_values_of_reef_and_deep_sea_fish_catching": 1,
        "economic_values_of_small_fish_catching": 1,
    },
)
def economic_value_of_fisheries():
    return (
        economic_values_of_lobsters_and_shrimp_catching()
        + economic_values_of_reef_and_deep_sea_fish_catching()
        + economic_values_of_small_fish_catching()
    )


@component.add(
    name="Potential Number of Reef and Deep Sea Fish in The Sea",
    units="ton",
    comp_type="Stateful",
    comp_subtype="Integ",
    depends_on={"_integ_potential_number_of_reef_and_deep_sea_fish_in_the_sea": 1},
    other_deps={
        "_integ_potential_number_of_reef_and_deep_sea_fish_in_the_sea": {
            "initial": {},
            "step": {
                "rate_of_reef_and_deep_sea_fish_increase": 1,
                "rate_of_reef_and_deep_sea_fish_decrease": 1,
            },
        }
    },
)
def potential_number_of_reef_and_deep_sea_fish_in_the_sea():
    return _integ_potential_number_of_reef_and_deep_sea_fish_in_the_sea()


_integ_potential_number_of_reef_and_deep_sea_fish_in_the_sea = Integ(
    lambda: rate_of_reef_and_deep_sea_fish_increase()
    - rate_of_reef_and_deep_sea_fish_decrease(),
    lambda: 100000 / 12,
    "_integ_potential_number_of_reef_and_deep_sea_fish_in_the_sea",
)


@component.add(
    name="Shrimp and Lobster Fishing Ratio",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "potential_number_of_shrimp_and_lobsters_in_the_sea": 1,
        "number_of_shrimp_and_lobsters_catching": 1,
        "time": 1,
    },
)
def shrimp_and_lobster_fishing_ratio():
    return if_then_else(
        potential_number_of_shrimp_and_lobsters_in_the_sea()
        < number_of_shrimp_and_lobsters_catching(),
        lambda: 0,
        lambda: np.random.uniform(5000 / 12, 10000 / 12, size=()),
    )


@component.add(
    name="Shrimp and Lobster Increase",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def shrimp_and_lobster_increase():
    return np.random.uniform(20000 / 12, 30000 / 12, size=())


@component.add(
    name="Small Fish Market Price",
    units="Rupiah/ton",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def small_fish_market_price():
    return np.random.uniform(25000000.0, 45000000.0, size=())


@component.add(
    name="Period of Fishing", units="Month", comp_type="Constant", comp_subtype="Normal"
)
def period_of_fishing():
    return 1


@component.add(
    name="Rate of Reef and Deep Sea Fish Catching",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"reef_and_deep_sea_fish_fishing_ratio": 1},
)
def rate_of_reef_and_deep_sea_fish_catching():
    return reef_and_deep_sea_fish_fishing_ratio()


@component.add(
    name="Rate of Reef and Deep Sea Fish Decrease",
    units="ton/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "rate_of_reef_and_deep_sea_fish_catching": 1,
        "period_of_fishing": 1,
        "age_of_reef_and_deep_sea_fish": 1,
        "potential_number_of_reef_and_deep_sea_fish_in_the_sea": 1,
    },
)
def rate_of_reef_and_deep_sea_fish_decrease():
    return (
        rate_of_reef_and_deep_sea_fish_catching() / period_of_fishing()
        + potential_number_of_reef_and_deep_sea_fish_in_the_sea()
        / age_of_reef_and_deep_sea_fish()
    )


@component.add(
    name="Potential Number of Small Fish in The Sea",
    units="ton",
    comp_type="Stateful",
    comp_subtype="Integ",
    depends_on={"_integ_potential_number_of_small_fish_in_the_sea": 1},
    other_deps={
        "_integ_potential_number_of_small_fish_in_the_sea": {
            "initial": {},
            "step": {
                "rate_of_small_fish_increase": 1,
                "rate_of_small_fish_decrease": 1,
            },
        }
    },
)
def potential_number_of_small_fish_in_the_sea():
    return _integ_potential_number_of_small_fish_in_the_sea()


_integ_potential_number_of_small_fish_in_the_sea = Integ(
    lambda: rate_of_small_fish_increase() - rate_of_small_fish_decrease(),
    lambda: 200000 / 12,
    "_integ_potential_number_of_small_fish_in_the_sea",
)


@component.add(
    name="Potential Number of Shrimp and Lobsters in The Sea",
    units="ton",
    comp_type="Stateful",
    comp_subtype="Integ",
    depends_on={"_integ_potential_number_of_shrimp_and_lobsters_in_the_sea": 1},
    other_deps={
        "_integ_potential_number_of_shrimp_and_lobsters_in_the_sea": {
            "initial": {},
            "step": {
                "rate_of_shrimp_and_lobster_increase": 1,
                "rate_of_shrimp_and_lobsters_decrease": 1,
            },
        }
    },
)
def potential_number_of_shrimp_and_lobsters_in_the_sea():
    return _integ_potential_number_of_shrimp_and_lobsters_in_the_sea()


_integ_potential_number_of_shrimp_and_lobsters_in_the_sea = Integ(
    lambda: rate_of_shrimp_and_lobster_increase()
    - rate_of_shrimp_and_lobsters_decrease(),
    lambda: 20000 / 12,
    "_integ_potential_number_of_shrimp_and_lobsters_in_the_sea",
)


@component.add(
    name="Quality Rate of Missiles",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def quality_rate_of_missiles():
    return 0.9


@component.add(
    name="Availability of Fighter Jet",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def availability_of_fighter_jet():
    return np.random.uniform(0.1, 0.15, size=())


@component.add(
    name="Availability of Medium Tank",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def availability_of_medium_tank():
    return 0.86


@component.add(
    name="Availability of Missiles",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def availability_of_missiles():
    return np.random.uniform(0.1, 0.15, size=())


@component.add(
    name="Availability of National Radar",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def availability_of_national_radar():
    return np.random.uniform(0.2, 0.25, size=())


@component.add(
    name="Availability of Propellant Industry",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def availability_of_propellant_industry():
    return np.random.uniform(0.008, 0.01, size=())


@component.add(
    name="Availability of Rocket",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def availability_of_rocket():
    return 0


@component.add(
    name="Availability of Submarine",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def availability_of_submarine():
    return 0.3


@component.add(
    name="Climate Change",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def climate_change():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="National Security Strategy",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def national_security_strategy():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Communication System",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def communication_system():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Cybersecurity",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def cybersecurity():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Defense and Security Regulation",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "cybersecurity": 1,
        "economic_factors": 1,
        "emergency_preparedness": 1,
        "international_relations": 1,
        "legal_framework": 1,
        "military_and_intelligent_agencies": 1,
        "national_security_strategy": 1,
        "public_opinion_and_ethics": 1,
        "technological_advances": 1,
        "threat_assesment": 1,
    },
)
def defense_and_security_regulation():
    return (
        cybersecurity() * 0.15
        + economic_factors() * 0.1
        + emergency_preparedness() * 0.1
        + international_relations() * 0.1
        + legal_framework() * 0.05
        + military_and_intelligent_agencies() * 0.15
        + national_security_strategy() * 0.1
        + public_opinion_and_ethics() * 0.05
        + technological_advances() * 0.1
        + threat_assesment() * 0.1
    )


@component.add(
    name="Economic Factors",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def economic_factors():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Development Program",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "impact_of_manufacturing_improvement": 1,
        "impact_of_technological_innovation": 1,
        "impact_of_naval_human_resources": 1,
    },
)
def development_program():
    return (
        0.4 * impact_of_manufacturing_improvement()
        + 0.3 * impact_of_technological_innovation()
        + 0.3 * impact_of_naval_human_resources()
    )


@component.add(
    name="Impact of Manufacturing Improvement",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def impact_of_manufacturing_improvement():
    return np.random.uniform(50, 55, size=())


@component.add(
    name="Impact of Medium Tanks",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "availability_of_medium_tank": 1,
        "performance_efficiency_of_medium_tank": 1,
        "quality_rate_of_medium_tank": 1,
    },
)
def impact_of_medium_tanks():
    return (
        availability_of_medium_tank() * 0.25
        + performance_efficiency_of_medium_tank() * 0.45
        + quality_rate_of_medium_tank() * 0.3
    )


@component.add(
    name="Impact of Missiles",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "availability_of_missiles": 1,
        "performance_efficiency_of_missiles": 1,
        "quality_rate_of_missiles": 1,
    },
)
def impact_of_missiles():
    return (
        availability_of_missiles() * 0.3
        + performance_efficiency_of_missiles() * 0.4
        + quality_rate_of_missiles() * 0.3
    )


@component.add(
    name="Impact of National Radar",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "availability_of_national_radar": 1,
        "performance_efficiency_of_national_radar": 1,
        "quality_rate_of_national_radar": 1,
    },
)
def impact_of_national_radar():
    return (
        availability_of_national_radar() * 0.35
        + performance_efficiency_of_national_radar() * 0.4
        + quality_rate_of_national_radar() * 0.25
    )


@component.add(
    name="Impact of Naval Human Resources",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def impact_of_naval_human_resources():
    return np.random.uniform(65, 75, size=())


@component.add(
    name="Performance Efficiency of Fighter Jet",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def performance_efficiency_of_fighter_jet():
    return np.random.uniform(0.8, 1, size=())


@component.add(
    name="Performance Efficiency of Medium Tank",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def performance_efficiency_of_medium_tank():
    return 0.878


@component.add(
    name="Technological Advances",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def technological_advances():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Number of Shrimp and Lobsters Catching",
    units="ton",
    comp_type="Stateful",
    comp_subtype="Integ",
    depends_on={"_integ_number_of_shrimp_and_lobsters_catching": 1},
    other_deps={
        "_integ_number_of_shrimp_and_lobsters_catching": {
            "initial": {},
            "step": {"rate_of_shrimp_and_lobster_catching": 1},
        }
    },
)
def number_of_shrimp_and_lobsters_catching():
    return _integ_number_of_shrimp_and_lobsters_catching()


_integ_number_of_shrimp_and_lobsters_catching = Integ(
    lambda: rate_of_shrimp_and_lobster_catching(),
    lambda: 10000 / 12,
    "_integ_number_of_shrimp_and_lobsters_catching",
)


@component.add(
    name="Quality Rate of Submarine",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def quality_rate_of_submarine():
    return 0.875


@component.add(
    name="Threat Assesment",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def threat_assesment():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Emergency preparedness",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def emergency_preparedness():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Quality Rate of Fighter Jet",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def quality_rate_of_fighter_jet():
    return 0.902


@component.add(
    name="Quality Rate of Medium Tank",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def quality_rate_of_medium_tank():
    return np.random.uniform(0.2, 0.25, size=())


@component.add(
    name="Physical Impact",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"climate_change": 1, "geographical_factors": 1},
)
def physical_impact():
    return (climate_change() * 0.5 + geographical_factors() * 0.5) * 20


@component.add(
    name="Quality Rate of National Radar",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def quality_rate_of_national_radar():
    return 0.82


@component.add(
    name="Quality Rate of Propellant Industry",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def quality_rate_of_propellant_industry():
    return 0.9


@component.add(
    name="Population Density",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def population_density():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Priority Program",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "impact_of_fighter_jet": 1,
        "impact_of_medium_tanks": 1,
        "impact_of_missiles": 1,
        "impact_of_national_radar": 1,
        "impact_of_propellant_industry": 1,
        "impact_of_rocket_development": 1,
        "impact_of_submarine": 1,
    },
)
def priority_program():
    return (
        impact_of_fighter_jet() * 0.15
        + impact_of_medium_tanks() * 0.15
        + impact_of_missiles() * 0.15
        + impact_of_national_radar() * 0.2
        + impact_of_propellant_industry() * 0.1
        + impact_of_rocket_development() * 0.1
        + impact_of_submarine() * 0.15
    ) * 100


@component.add(
    name="Geographical Factors",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def geographical_factors():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Military and Intelligent Agencies",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def military_and_intelligent_agencies():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Legal Framework",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def legal_framework():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Technological Impact",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"communication_system": 1, "maritime_surveillance": 1},
)
def technological_impact():
    return (communication_system() * 0.5 + maritime_surveillance() * 0.5) * 20


@component.add(
    name="Impact of Propellant Industry",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "availability_of_propellant_industry": 1,
        "performance_efficiency_of_propellant_industry": 1,
        "quality_rate_of_propellant_industry": 1,
    },
)
def impact_of_propellant_industry():
    return (
        availability_of_propellant_industry() * 0.3
        + performance_efficiency_of_propellant_industry() * 0.4
        + quality_rate_of_propellant_industry() * 0.3
    )


@component.add(
    name="Impact of Rocket Development",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "availability_of_rocket": 1,
        "performance_efficiency_of_rocket": 1,
        "quality_rate_of_rocket": 1,
    },
)
def impact_of_rocket_development():
    return (
        availability_of_rocket() * 0.3
        + performance_efficiency_of_rocket() * 0.4
        + quality_rate_of_rocket() * 0.3
    )


@component.add(
    name="Impact of Submarine",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "availability_of_submarine": 1,
        "performance_efficiency_of_submarine": 1,
        "quality_rate_of_submarine": 1,
    },
)
def impact_of_submarine():
    return (
        availability_of_submarine() * 0.25
        + performance_efficiency_of_submarine() * 0.5
        + quality_rate_of_submarine() * 0.25
    )


@component.add(
    name="Impact of Fighter Jet",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "availability_of_fighter_jet": 1,
        "performance_efficiency_of_fighter_jet": 1,
        "quality_rate_of_fighter_jet": 1,
    },
)
def impact_of_fighter_jet():
    return (
        availability_of_fighter_jet() * 0.3
        + performance_efficiency_of_fighter_jet() * 0.4
        + quality_rate_of_fighter_jet() * 0.3
    )


@component.add(
    name="Human Resource Impact",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"population_density": 1, "workforce_quality": 1},
)
def human_resource_impact():
    return (population_density() * 0.5 + workforce_quality() * 0.5) * 20


@component.add(
    name="Performance Efficiency of Submarine",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def performance_efficiency_of_submarine():
    return np.random.uniform(0.8, 1, size=())


@component.add(
    name="International relations",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def international_relations():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Quality Rate of Rocket",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def quality_rate_of_rocket():
    return 0.9


@component.add(
    name="Performance Efficiency of Rocket",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def performance_efficiency_of_rocket():
    return 0.9


@component.add(
    name="Impact of Technological Innovation",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def impact_of_technological_innovation():
    return np.random.uniform(60, 75, size=())


@component.add(
    name="Performance Efficiency of Missiles",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def performance_efficiency_of_missiles():
    return np.random.uniform(0.8, 1, size=())


@component.add(
    name='"State Revenue (Tax)"',
    units="Rupiah",
    comp_type="Constant",
    comp_subtype="Normal",
)
def state_revenue_tax():
    return 1865700000000000.0


@component.add(
    name="Public Opinion and Ethics",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def public_opinion_and_ethics():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Performance Efficiency of Propellant Industry",
    units="Percent",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def performance_efficiency_of_propellant_industry():
    return np.random.uniform(0.8, 1, size=())


@component.add(
    name="Performance Efficiency of National Radar",
    units="Percent",
    comp_type="Constant",
    comp_subtype="Normal",
)
def performance_efficiency_of_national_radar():
    return 0.894


@component.add(
    name="National Defense and Security Infrastructure",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "defense_and_security_regulation": 1,
        "defense_budgeting": 1,
        "development_program": 1,
        "marine_resource_utilization": 1,
        "priority_program": 1,
    },
)
def national_defense_and_security_infrastructure():
    return (
        0.15 * defense_and_security_regulation()
        + 0.2 * defense_budgeting()
        + 0.2 * development_program()
        + 0.1 * marine_resource_utilization()
        + 0.35 * priority_program()
    )


@component.add(
    name="Period of Time", units="Month", comp_type="Constant", comp_subtype="Normal"
)
def period_of_time():
    return 1


@component.add(
    name="Level of Threat",
    units="Percentage/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "national_sea_threat_risk": 1,
        "north_natuna_defense_and_security": 1,
        "period_of_time": 1,
    },
)
def level_of_threat():
    return (
        national_sea_threat_risk() / north_natuna_defense_and_security()
    ) / period_of_time()


@component.add(
    name="Defense Score",
    units="Percentage/Month",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "naval_defense_posture": 1,
        "north_natuna_defense_and_security": 1,
        "period_of_time": 1,
    },
)
def defense_score():
    return (
        naval_defense_posture() / north_natuna_defense_and_security()
    ) / period_of_time()


@component.add(
    name="Foreign Policy",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def foreign_policy():
    return np.random.uniform(1, 3, size=()) * 20


@component.add(
    name="Misuses of AIS and Positioning Data Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def misuses_of_ais_and_positioning_data_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Combined Deploy",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def combined_deploy():
    return np.random.uniform(1, 2, size=()) * 20


@component.add(
    name="Multilateral Power",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def multilateral_power():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Diplomacy Ability",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"diplomatic_network": 1, "foreign_policy": 1, "multilateral_power": 1},
)
def diplomacy_ability():
    return (
        diplomatic_network() * 0.4 + foreign_policy() * 0.3 + multilateral_power() * 0.3
    )


@component.add(
    name="Diplomatic Network",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def diplomatic_network():
    return np.random.uniform(1, 3, size=()) * 20


@component.add(
    name="Disinfromation Campaign Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def disinfromation_campaign_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Disinfromation Campaign Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def disinfromation_campaign_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Drug Shipping Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def drug_shipping_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Drug Shipping Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def drug_shipping_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="North Natuna Defense and Security",
    units="Percentage",
    comp_type="Stateful",
    comp_subtype="Integ",
    depends_on={"_integ_north_natuna_defense_and_security": 1},
    other_deps={
        "_integ_north_natuna_defense_and_security": {
            "initial": {},
            "step": {"defense_score": 1, "level_of_threat": 1},
        }
    },
)
def north_natuna_defense_and_security():
    return _integ_north_natuna_defense_and_security()


_integ_north_natuna_defense_and_security = Integ(
    lambda: defense_score() - level_of_threat(),
    lambda: 60,
    "_integ_north_natuna_defense_and_security",
)


@component.add(
    name="Embargo Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def embargo_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Embargo Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def embargo_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Manipulation Signal Used Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def manipulation_signal_used_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Support Capabilities",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def support_capabilities():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Espionage by Maritime Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def espionage_by_maritime_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Espionage by Maritime Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def espionage_by_maritime_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Piracy Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def piracy_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Piracy Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def piracy_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Firewall Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def firewall_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Firewall Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def firewall_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Proxy Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def proxy_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Grouped Deploy",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def grouped_deploy():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Misuses of AIS and Positioning Data Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def misuses_of_ais_and_positioning_data_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Regional Empowerment Capabilities",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def regional_empowerment_capabilities():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Manipulation Signal Used Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def manipulation_signal_used_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Natural Disaster Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def natural_disaster_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Natural Disaster Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def natural_disaster_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="IT System Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def it_system_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Illegal Fishing Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def illegal_fishing_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Illegal Fishing Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def illegal_fishing_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Intelligence Ability",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def intelligence_ability():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Military Invasion Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def military_invasion_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Smuggling Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def smuggling_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Military Invasion Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def military_invasion_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Social Media Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def social_media_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Naval Defense Posture",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"naval_strength": 1, "naval_capabilities": 1, "naval_deployment": 1},
)
def naval_defense_posture():
    return (
        naval_strength() * 0.2 + naval_capabilities() * 0.2 + naval_deployment() * 0.2
    )


@component.add(
    name="Social Media Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def social_media_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Proxy Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def proxy_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Smuggling Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def smuggling_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Terorism Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def terorism_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Naval Deployment",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"grouped_deploy": 1, "combined_deploy": 1, "unit_deploy": 1},
)
def naval_deployment():
    return grouped_deploy() * 0.5 + combined_deploy() * 0.3 + unit_deploy() * 0.2


@component.add(
    name="Unit Deploy",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def unit_deploy():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Terorism Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def terorism_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Sabotage Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def sabotage_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Sabotage Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def sabotage_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Aircraft Strength",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"enablers_aircraft": 1, "fighters_aircraft_score": 1},
)
def aircraft_strength():
    return enablers_aircraft() * 0.5 + fighters_aircraft_score() * 0.5


@component.add(
    name="Combat Vehicle Score",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def combat_vehicle_score():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Harbour",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "refuel": 1,
        "repair": 1,
        "recreation": 1,
        "replenishment": 1,
        "rest": 1,
    },
)
def harbour():
    return (
        refuel() * 0.3
        + repair() * 0.2
        + recreation() * 0.2
        + replenishment() * 0.15
        + rest() * 0.15
    )


@component.add(
    name="Refuel",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def refuel():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Repair",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def repair():
    return np.random.uniform(2, 3, size=()) * 20


@component.add(
    name="Replenishment",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def replenishment():
    return np.random.uniform(2, 3, size=()) * 20


@component.add(
    name="Rest",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def rest():
    return np.random.uniform(2, 3, size=()) * 20


@component.add(
    name="Patroling",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def patroling():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Marine Personel Forces",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def marine_personel_forces():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Fighters Aircraft Score",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def fighters_aircraft_score():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Naval Strength",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "warships_strength": 1,
        "aircraft_strength": 1,
        "harbour": 1,
        "marine_forces_strength": 1,
    },
)
def naval_strength():
    return (
        warships_strength() * 0.5
        + aircraft_strength() * 0.2
        + harbour() * 0.15
        + marine_forces_strength() * 0.15
    )


@component.add(
    name="IT System Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def it_system_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Recreation",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def recreation():
    return np.random.uniform(2, 3, size=()) * 20


@component.add(
    name="Supporting",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def supporting():
    return np.random.uniform(1, 2, size=()) * 20


@component.add(
    name="Enablers Aircraft",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def enablers_aircraft():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Marine Ability Score",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def marine_ability_score():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Marine Forces Strength",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "combat_vehicle_score": 1,
        "marine_ability_score": 1,
        "marine_personel_forces": 1,
    },
)
def marine_forces_strength():
    return (
        combat_vehicle_score() * 0.3
        + marine_ability_score() * 0.3
        + marine_personel_forces() * 0.4
    )


@component.add(
    name="Striking",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def striking():
    return np.random.uniform(3, 4, size=()) * 20


@component.add(
    name="Hijacking Severity",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def hijacking_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Hijacking Probability",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def hijacking_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Cyber Attack Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "espionage_by_maritime_level_of_threats": 1,
        "firewall_level_of_threats": 1,
        "it_system_level_of_threats": 1,
        "manipulation_signal_used_level_of_threats": 1,
        "misuses_of_ais_and_positioning_data_level_of_threats": 1,
        "number_of_cyber_attack": 1,
    },
)
def cyber_attack_level_of_threats():
    return (
        espionage_by_maritime_level_of_threats()
        + firewall_level_of_threats()
        + it_system_level_of_threats()
        + manipulation_signal_used_level_of_threats()
        + misuses_of_ais_and_positioning_data_level_of_threats()
    ) / number_of_cyber_attack()


@component.add(
    name="Disinfromation Campaign Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "disinfromation_campaign_probability": 1,
        "disinfromation_campaign_severity": 1,
    },
)
def disinfromation_campaign_level_of_threats():
    return disinfromation_campaign_probability() + disinfromation_campaign_severity()


@component.add(
    name="National Sea Threat Risk",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "hybrid_risk_level": 1,
        "military_risk_level": 1,
        "non_military_risk_level": 1,
    },
)
def national_sea_threat_risk():
    return (
        (hybrid_risk_level() + military_risk_level() + non_military_risk_level()) / 3
    ) * 100


@component.add(
    name="Drugs Shipping Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"drug_shipping_probability": 1, "drug_shipping_severity": 1},
)
def drugs_shipping_level_of_threats():
    return drug_shipping_probability() + drug_shipping_severity()


@component.add(
    name="Embargo Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"embargo_probability": 1, "embargo_severity": 1},
)
def embargo_level_of_threats():
    return embargo_probability() + embargo_severity()


@component.add(
    name="Espionage by Maritime Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "espionage_by_maritime_probability": 1,
        "espionage_by_maritime_severity": 1,
    },
)
def espionage_by_maritime_level_of_threats():
    return espionage_by_maritime_probability() + espionage_by_maritime_severity()


@component.add(
    name="Firewall Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"firewall_probability": 1, "firewall_severity": 1},
)
def firewall_level_of_threats():
    return firewall_probability() + firewall_severity()


@component.add(
    name="Hijacking Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"hijacking_probability": 1, "hijacking_severity": 1},
)
def hijacking_level_of_threats():
    return hijacking_probability() + hijacking_severity()


@component.add(
    name="Hybrid Risk Level",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "disinfromation_campaign_level_of_threats": 1,
        "proxy_level_of_threats": 1,
        "social_media_level_of_threats": 1,
        "risk_level_maximum_score": 1,
        "number_of_hybrid_threats": 1,
    },
)
def hybrid_risk_level():
    return (
        disinfromation_campaign_level_of_threats()
        + proxy_level_of_threats()
        + social_media_level_of_threats()
    ) / (risk_level_maximum_score() * number_of_hybrid_threats())


@component.add(
    name="Illegal Fishing Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"illegal_fishing_probability": 1, "illegal_fishing_severity": 1},
)
def illegal_fishing_level_of_threats():
    return illegal_fishing_probability() + illegal_fishing_severity()


@component.add(
    name="Military Invasion Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"military_invasion_probability": 1, "military_invasion_severity": 1},
)
def military_invasion_level_of_threats():
    return military_invasion_probability() + military_invasion_severity()


@component.add(
    name="IT System Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"it_system_probability": 1, "it_system_severity": 1},
)
def it_system_level_of_threats():
    return it_system_probability() + it_system_severity()


@component.add(
    name="Manipulation Signal Used Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "manipulation_signal_used_probability": 1,
        "manipulation_signal_used_severity": 1,
    },
)
def manipulation_signal_used_level_of_threats():
    return manipulation_signal_used_probability() + manipulation_signal_used_severity()


@component.add(
    name="Piracy Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"piracy_probability": 1, "piracy_severity": 1},
)
def piracy_level_of_threats():
    return piracy_probability() + piracy_severity()


@component.add(
    name="Military Risk Level",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "cyber_attack_level_of_threats": 1,
        "embargo_level_of_threats": 1,
        "military_invasion_level_of_threats": 1,
        "sabotage_level_of_threats": 1,
        "terorism_level_of_threats": 1,
        "risk_level_maximum_score": 1,
        "number_of_military_threats": 1,
    },
)
def military_risk_level():
    return (
        cyber_attack_level_of_threats()
        + embargo_level_of_threats()
        + military_invasion_level_of_threats()
        + sabotage_level_of_threats()
        + terorism_level_of_threats()
    ) / (risk_level_maximum_score() * number_of_military_threats())


@component.add(
    name="Misuses of AIS and Positioning Data Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "misuses_of_ais_and_positioning_data_probability": 1,
        "misuses_of_ais_and_positioning_data_severity": 1,
    },
)
def misuses_of_ais_and_positioning_data_level_of_threats():
    return (
        misuses_of_ais_and_positioning_data_probability()
        + misuses_of_ais_and_positioning_data_severity()
    )


@component.add(
    name="Sabotage Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"sabotage_probability": 1, "sabotage_severity": 1},
)
def sabotage_level_of_threats():
    return sabotage_probability() + sabotage_severity()


@component.add(
    name="Terorism Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"terorism_probability": 1, "terorism_severity": 1},
)
def terorism_level_of_threats():
    return terorism_probability() + terorism_severity()


@component.add(
    name="Natural Disasters Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"natural_disaster_probability": 1, "natural_disaster_severity": 1},
)
def natural_disasters_level_of_threats():
    return natural_disaster_probability() + natural_disaster_severity()


@component.add(
    name="Non Military Risk Level",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={
        "drugs_shipping_level_of_threats": 1,
        "hijacking_level_of_threats": 1,
        "illegal_fishing_level_of_threats": 1,
        "natural_disasters_level_of_threats": 1,
        "piracy_level_of_threats": 1,
        "smuggling_level_of_threats": 1,
        "risk_level_maximum_score": 1,
        "number_of_non_military_threats": 1,
    },
)
def non_military_risk_level():
    return (
        drugs_shipping_level_of_threats()
        + hijacking_level_of_threats()
        + illegal_fishing_level_of_threats()
        + natural_disasters_level_of_threats()
        + piracy_level_of_threats()
        + smuggling_level_of_threats()
    ) / (risk_level_maximum_score() * number_of_non_military_threats())


@component.add(
    name="Number of Cyber Attack",
    units="Dmnl",
    comp_type="Constant",
    comp_subtype="Normal",
)
def number_of_cyber_attack():
    return 5


@component.add(
    name="Number of Hybrid Threats",
    units="Dmnl",
    comp_type="Constant",
    comp_subtype="Normal",
)
def number_of_hybrid_threats():
    return 3


@component.add(
    name="Number of Military Threats",
    units="Dmnl",
    comp_type="Constant",
    comp_subtype="Normal",
)
def number_of_military_threats():
    return 5


@component.add(
    name="Number of Non Military Threats",
    units="Dmnl",
    comp_type="Constant",
    comp_subtype="Normal",
)
def number_of_non_military_threats():
    return 6


@component.add(
    name="Social Media Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"social_media_probability": 1, "social_media_severity": 1},
)
def social_media_level_of_threats():
    return social_media_probability() + social_media_severity()


@component.add(
    name="Risk Level Maximum Score",
    units="Dmnl",
    comp_type="Constant",
    comp_subtype="Normal",
)
def risk_level_maximum_score():
    return 9


@component.add(
    name="Proxy Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"proxy_probability": 1, "proxy_severity": 1},
)
def proxy_level_of_threats():
    return proxy_probability() + proxy_severity()


@component.add(
    name="Smuggling Level of Threats",
    units="Dmnl",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"smuggling_probability": 1, "smuggling_severity": 1},
)
def smuggling_level_of_threats():
    return smuggling_probability() + smuggling_severity()
