"""
Python model 'export-model-change-final-step.py'
Translated using PySD
"""

from pathlib import Path
import numpy as np

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
    name="Level of Threat",
    units="1",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"national_sea_threat_risk": 1, "north_natuna_defense_and_security": 1},
)
def level_of_threat():
    return national_sea_threat_risk() / north_natuna_defense_and_security()


@component.add(
    name="Defense Score",
    units="Dmnl/Year",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"naval_defense_posture": 1, "north_natuna_defense_and_security": 1},
)
def defense_score():
    return naval_defense_posture() / north_natuna_defense_and_security()


@component.add(
    name="Foreign Policy",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def foreign_policy():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Misuses of AIS and Positioning Data Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def misuses_of_ais_and_positioning_data_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Combined Deploy",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def combined_deploy():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Multilateral Power",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def multilateral_power():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Defense Capability",
    units="1",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def defense_capability():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Diplomacy Ability",
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
    units="1",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def diplomatic_network():
    return np.random.uniform(1, 5, size=()) * 20


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
    },
)
def naval_capabilities():
    return (
        defense_capability() * 0.3
        + diplomacy_ability() * 0.3
        + support_capabilities() * 0.1
        + intelligence_ability() * 0.15
        + regional_empowerment_capabilities() * 0.15
    )


@component.add(
    name="Disinfromation Campaign Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def disinfromation_campaign_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Disinfromation Campaign Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def disinfromation_campaign_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Drug Shipping Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def drug_shipping_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Drug Shipping Severity",
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
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def embargo_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Embargo Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def embargo_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Manipulation Signal Used Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def manipulation_signal_used_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Support Capabilities",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def support_capabilities():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Espionage by Maritime Probability",
    units="Level",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def espionage_by_maritime_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Espionage by Maritime Severity",
    units="Level",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def espionage_by_maritime_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Piracy Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def piracy_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Piracy Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def piracy_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Firewall Probability",
    units="Level",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def firewall_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Firewall Severity",
    units="Level",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def firewall_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Proxy Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def proxy_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Grouped Deploy",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def grouped_deploy():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Misuses of AIS and Positioning Data Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def misuses_of_ais_and_positioning_data_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Regional Empowerment Capabilities",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def regional_empowerment_capabilities():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Manipulation Signal Used Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def manipulation_signal_used_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Natural Disaster Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def natural_disaster_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Natural Disaster Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def natural_disaster_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="IT System Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def it_system_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Illegal Fishing Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def illegal_fishing_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Illegal Fishing Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def illegal_fishing_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Intelligence Ability",
    units="1",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def intelligence_ability():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Military Invasion Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def military_invasion_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Smuggling Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def smuggling_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Military Invasion Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def military_invasion_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Social Media Probability",
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
        naval_strength() * 0.33
        + naval_capabilities() * 0.33
        + naval_deployment() * 0.33
    )


@component.add(
    name="Social Media Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def social_media_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Proxy Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def proxy_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Smuggling Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def smuggling_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Terorism Probability",
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
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def unit_deploy():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Terorism Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def terorism_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Sabotage Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def sabotage_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Sabotage Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def sabotage_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Aircraft Strength",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"enablers_aircraft": 1, "fighters_aircraft_score": 1},
)
def aircraft_strength():
    return enablers_aircraft() * 0.5 + fighters_aircraft_score() * 0.5


@component.add(
    name="Combat Vehicle Score",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def combat_vehicle_score():
    return np.random.uniform(1, 5, size=()) * 20


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
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Repair",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def repair():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Replenishment",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def replenishment():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Rest",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def rest():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Patroling",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def patroling():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Marine Personel Forces",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def marine_personel_forces():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Fighters Aircraft Score",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def fighters_aircraft_score():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Warships Strength",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"patroling": 1, "striking": 1, "supporting": 1},
)
def warships_strength():
    return patroling() * 0.3 + striking() * 0.5 + supporting() * 0.2


@component.add(
    name="Naval Strength",
    units="Dmnl",
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
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Supporting",
    units="Percentage",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def supporting():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Enablers Aircraft",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def enablers_aircraft():
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Marine Ability Score",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def marine_ability_score():
    return np.random.uniform(1, 5, size=()) * 20


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
    return np.random.uniform(1, 5, size=()) * 20


@component.add(
    name="Hijacking Severity",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def hijacking_severity():
    return np.random.uniform(1, 4, size=())


@component.add(
    name="Hijacking Probability",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"time": 1},
)
def hijacking_probability():
    return np.random.uniform(1, 5, size=())


@component.add(
    name="Cyber Attack Level of Threats",
    units="Level",
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
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"drug_shipping_probability": 1, "drug_shipping_severity": 1},
)
def drugs_shipping_level_of_threats():
    return drug_shipping_probability() + drug_shipping_severity()


@component.add(
    name="Embargo Level of Threats",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"embargo_probability": 1, "embargo_severity": 1},
)
def embargo_level_of_threats():
    return embargo_probability() + embargo_severity()


@component.add(
    name="Espionage by Maritime Level of Threats",
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
    units="Level",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"firewall_probability": 1, "firewall_severity": 1},
)
def firewall_level_of_threats():
    return firewall_probability() + firewall_severity()


@component.add(
    name="Hijacking Level of Threats",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"hijacking_probability": 1, "hijacking_severity": 1},
)
def hijacking_level_of_threats():
    return hijacking_probability() + hijacking_severity()


@component.add(
    name="Hybrid Risk Level",
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
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"illegal_fishing_probability": 1, "illegal_fishing_severity": 1},
)
def illegal_fishing_level_of_threats():
    return illegal_fishing_probability() + illegal_fishing_severity()


@component.add(
    name="Military Invasion Level of Threats",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"military_invasion_probability": 1, "military_invasion_severity": 1},
)
def military_invasion_level_of_threats():
    return military_invasion_probability() + military_invasion_severity()


@component.add(
    name="IT System Level of Threats",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"it_system_probability": 1, "it_system_severity": 1},
)
def it_system_level_of_threats():
    return it_system_probability() + it_system_severity()


@component.add(
    name="Manipulation Signal Used Level of Threats",
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
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"piracy_probability": 1, "piracy_severity": 1},
)
def piracy_level_of_threats():
    return piracy_probability() + piracy_severity()


@component.add(
    name="Military Risk Level",
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
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"sabotage_probability": 1, "sabotage_severity": 1},
)
def sabotage_level_of_threats():
    return sabotage_probability() + sabotage_severity()


@component.add(
    name="Terorism Level of Threats",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"terorism_probability": 1, "terorism_severity": 1},
)
def terorism_level_of_threats():
    return terorism_probability() + terorism_severity()


@component.add(
    name="Natural Disasters Level of Threats",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"natural_disaster_probability": 1, "natural_disaster_severity": 1},
)
def natural_disasters_level_of_threats():
    return natural_disaster_probability() + natural_disaster_severity()


@component.add(
    name="Non Military Risk Level",
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
    name="Number of Cyber Attack", comp_type="Constant", comp_subtype="Normal"
)
def number_of_cyber_attack():
    return 5


@component.add(
    name="Number of Hybrid Threats", comp_type="Constant", comp_subtype="Normal"
)
def number_of_hybrid_threats():
    return 3


@component.add(
    name="Number of Military Threats", comp_type="Constant", comp_subtype="Normal"
)
def number_of_military_threats():
    return 5


@component.add(
    name="Number of Non Military Threats", comp_type="Constant", comp_subtype="Normal"
)
def number_of_non_military_threats():
    return 6


@component.add(
    name="Social Media Level of Threats",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"social_media_probability": 1, "social_media_severity": 1},
)
def social_media_level_of_threats():
    return social_media_probability() + social_media_severity()


@component.add(
    name="Risk Level Maximum Score", comp_type="Constant", comp_subtype="Normal"
)
def risk_level_maximum_score():
    return 9


@component.add(
    name="Proxy Level of Threats",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"proxy_probability": 1, "proxy_severity": 1},
)
def proxy_level_of_threats():
    return proxy_probability() + proxy_severity()


@component.add(
    name="Smuggling Level of Threats",
    comp_type="Auxiliary",
    comp_subtype="Normal",
    depends_on={"smuggling_probability": 1, "smuggling_severity": 1},
)
def smuggling_level_of_threats():
    return smuggling_probability() + smuggling_severity()
