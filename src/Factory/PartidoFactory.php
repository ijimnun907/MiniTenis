<?php

namespace App\Factory;

use App\Entity\Partido;
use App\Repository\PartidoRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Partido>
 *
 * @method        Partido|Proxy                              create(array|callable $attributes = [])
 * @method static Partido|Proxy                              createOne(array $attributes = [])
 * @method static Partido|Proxy                              find(object|array|mixed $criteria)
 * @method static Partido|Proxy                              findOrCreate(array $attributes)
 * @method static Partido|Proxy                              first(string $sortedField = 'id')
 * @method static Partido|Proxy                              last(string $sortedField = 'id')
 * @method static Partido|Proxy                              random(array $attributes = [])
 * @method static Partido|Proxy                              randomOrCreate(array $attributes = [])
 * @method static PartidoRepository|ProxyRepositoryDecorator repository()
 * @method static Partido[]|Proxy[]                          all()
 * @method static Partido[]|Proxy[]                          createMany(int $number, array|callable $attributes = [])
 * @method static Partido[]|Proxy[]                          createSequence(iterable|callable $sequence)
 * @method static Partido[]|Proxy[]                          findBy(array $attributes)
 * @method static Partido[]|Proxy[]                          randomRange(int $min, int $max, array $attributes = [])
 * @method static Partido[]|Proxy[]                          randomSet(int $number, array $attributes = [])
 */
final class PartidoFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Partido::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'fecha' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'numJuegos1' => self::faker()->randomNumber(),
            'numJuegos2' => self::faker()->randomNumber(),
            'puntuacion1' => self::faker()->randomNumber(),
            'puntuacion2' => self::faker()->randomNumber(),
            'servicioActual' => self::faker()->randomNumber(),
            'jugador1' => SocioFactory::random(),
            'jugador2' => SocioFactory::random(),
            'juez' => SocioFactory::random()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Partido $partido): void {})
        ;
    }
}
